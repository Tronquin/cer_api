<?php
namespace App\Handler;

use App\Service\ERPService;
use App\Reservation;
use App\Typology;
use App\Apartment;
use App\Experience;
use App\Package;
use App\User;
use App\Session;
use Illuminate\Support\Facades\Hash;
use App\ReservationServicePersistence;
use App\Service\EmailService;
use App\Handler\Web\SendConfirmationReserveHandler;
use CTrans;

/**
 * Registra una reservacion en el ERP
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class CreateReservationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $userExist = User::query()->where('email', $this->params['cliente_email'])->first();
        $iso = $this->params['iso'];

        if ($userExist) {

            $user_id = $userExist->id;
        
        }else{
            $user = new User();
            $user->name = $this->params['cliente_nombre'];
            $user->last_name = $this->params['cliente_apellido'];
            $user->email = $this->params['cliente_email'];
            $user->phone = $this->params['cliente_telefono'];
            // contraseña provisional
            $user->password = Hash::make(1234);
            $user->save();
    
            $clientIp = $this->params['ip'];
            $minutes = config('oauth2.time_expire');
            $token = base64_encode(Hash::make($user['id'] . md5('Castro_Proyect') . $clientIp));
    
            $session = new Session();
            $session->user_id = $user->id;
            $session->token = $token;
            $session->remember_me = false;
            $session->expired_at = new \DateTime("+{$minutes} minutes");
            $session->save();
            $user_id = $user->id;
            EmailService::send('email.registerUser', CTrans::trans('email.subject.registerUser', $iso), [$user->email], compact('user', 'iso'));
        }
        $response = ERPService::createReservation($this->params);
        
        if(isset($token))
        $response['session'] = $token;
        
        foreach($response['data'] as $reservation_client){
            \App::setLocale($reservation_client['iso']);
            if($reservation_client['sendEmail'] === 1){
                $email_data = [];
                $email_data['reserva_id'] = $reservation_client['reserva']['id'];
                $email_data['iso'] = $reservation_client['iso'];
                $handler = new SendConfirmationReserveHandler($email_data);
                $handler->processHandler();
                $data = $handler->getData();
                
                if (!$handler->isSuccess()) {
                    
                    return $response = [
                        'res' => 0,
                        'msg' => CTrans::trans('booking.msg.bookingError', $iso),
                        'data' => []
                    ];
                }
            }
            \App::setLocale('es');

            foreach($this->params['apartamentos'] as &$apartamento){
                if(count($apartamento['extras']) > 0){

                    if($apartamento['tipologia_id'] === $reservation_client['reserva']['tipologia_id'] && 
                    $apartamento['experiencia_id'] === $reservation_client['reserva']['experiencia_id'] && 
                    $apartamento['regimen_id'] === $reservation_client['reserva']['tarifa_id'] && 
                    $apartamento['politica_id'] === $reservation_client['reserva']['politica_cancelacion']['id'] && 
                    $apartamento['promocion_id'] === $reservation_client['reserva']['promocion_id'] &&
                    $apartamento['adultos'] === $reservation_client['reserva']['adultos'] &&
                    $apartamento['ninos'] === $reservation_client['reserva']['ninos'] &&
                    $apartamento['adultos'] === $reservation_client['reserva']['adultos']){
    
                        $apartamento['pago_extras'] = 0;
                        $apartamento['reserva_id'] = $reservation_client['reserva']['id'];
                        foreach($apartamento['extras'] as &$extra){
                            $extra['original_id'] = $extra['id'];
                            $extra['id'] = $extra['extra_id'];
                        }
                        $services = ERPService::addReservationService($apartamento);
                        foreach ($apartamento['extras'] as $extra) {
                            $service_persistence = new ReservationServicePersistence();
                            
                            $service_persistence->reserva_id = $apartamento['reserva_id'];
                            $service_persistence->extra_id = $extra['original_id'];
                            $service_persistence->cantidad = $extra['cantidad'];
                            $service_persistence->status_id = 2;
                            
                            $service_persistence->save();
                        }
                        $response['services'][] = $services['data']['pago'];
                    }
                }
            }
            $reservation = new Reservation();
            $checkin = date("Y-m-d",strtotime($reservation_client['reserva']['fecha_entrada']));
            $checkout = date("Y-m-d",strtotime($reservation_client['reserva']['fecha_salida']));

            $tipologia_id = Typology::where('tipologia_id',$reservation_client['reserva']['tipologia_id'])
                                        ->where('type','erp')
                                        ->first()->id;

            $apartamento_id = Apartment::where('apartamento_id',$reservation_client['reserva']['ventas'][0]['concepto_id'])
            ->where('type','erp')
            ->first()->id;

            $experiencia_id = Experience::where('experiencia_id',$reservation_client['reserva']['experiencia_id'])
            ->where('type','erp')
            ->first()->id;

            $package_id = Package::where('tarifa_id',$reservation_client['reserva']['tarifa_id'])
            ->where('type','erp')
            ->first()->id;             

            $reservation->reserva_id_erp = $reservation_client['reserva']['id'];
            $reservation->localizador_erp = $reservation_client['reserva']['localizador'];
            $reservation->ubicacion_id = $reservation_client['reserva']['ubicacion_id'];
            $reservation->checkin = $checkin;
            $reservation->checkout = $checkout;
            $reservation->apartment_id = $apartamento_id;
            $reservation->typology_id = $tipologia_id;
            $reservation->experience_id = $experiencia_id;
            $reservation->regimen_id = $package_id;
            $reservation->policy_id = $reservation_client['reserva']['politica_cancelacion']['id'];
            $reservation->promotion_id = $reservation_client['reserva']['promocion_id'];
            $reservation->adults = $reservation_client['reserva']['adultos'];
            $reservation->kids = $reservation_client['reserva']['ninos'];
            $reservation->amount = $reservation_client['reserva']['total_reserva'];
            $reservation->payment_id = $reservation_client['payment_id'];
            $reservation->iso = $reservation_client['iso'];

            if ($this->params['no_login']) {
                $reservation->no_session_user_id = $user_id;
            } else {
                $reservation->user_id = $user_id;
            }

            $reservation->save();

            $dato = Reservation::where('id',$reservation->id)->first()->toArray();
            $dato['experiencia'] = Experience::where('id',$dato['experience_id'])->with(['extras'])->first();
            $dato['user'] = Reservation::find($dato['id'])->user;
            $dato['cancelation_policy'] = Reservation::find($dato['id'])->cancelation_policy;
            $dato['packages'] = Reservation::find($dato['id'])->package;
            $dato['promotion'] = Reservation::find($dato['id'])->promotion;
            $dato['apartment'] = Reservation::find($dato['id'])->apartment;
            $dato['identificador'] = $dato['localizador_erp'].'-Apt: '.$dato['apartment']['nombre'];
            $dato['pending_payment'] = $reservation_client['payment_id'];
            $handler = new AvailabilityServiceHandler(['reserva_id' => $dato['reserva_id_erp'],'funcion' => 'checkin']);
            $handler->processHandler();
            
            if ($handler->isSuccess()) {
                $extras_contratados = $handler->getData();
                $dato['extras'] = $extras_contratados['data']['list']['extras']['extras_contratados'];
            }
            $response['reservas'][] = $dato;
        }
        
        unset($response['data']);
        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'apartamentos' => 'required',
            'cliente_email' => 'required|email',
            'cliente_nombre' => 'required',
            'cliente_apellido' => 'required',
            'cliente_telefono' => 'required',
            //'cliente_pais' => 'required|regex:/^[A-Z]{2}$/',
        ];
    }

}