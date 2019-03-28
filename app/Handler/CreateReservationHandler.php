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
use App\Service\EmailService;

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
            EmailService::send('email.registerUser', [$user->email], compact('user'));
        }

        $response = ERPService::createReservation($this->params);
        
        if(isset($token))
        $response['session'] = $token;

        $reservation = new Reservation();
        $checkin = date("Y-m-d",strtotime($response['data']['reserva']['fecha_entrada']));
        $checkout = date("Y-m-d",strtotime($response['data']['reserva']['fecha_salida']));

        $tipologia_id = Typology::where('tipologia_id',$response['data']['reserva']['tipologia_id'])
                                    ->where('type','erp')
                                    ->first()->id;

        $apartamento_id = Apartment::where('apartamento_id',$response['data']['reserva']['ventas'][0]['concepto_id'])
        ->where('type','erp')
        ->first()->id;

        $experiencia_id = Experience::where('experiencia_id',$response['data']['reserva']['experiencia_id'])
        ->where('type','erp')
        ->first()->id;

        $package_id = Package::where('tarifa_id',$response['data']['reserva']['tarifa_id'])
        ->where('type','erp')
        ->first()->id;             

        $reservation->reserva_id_erp = $response['data']['reserva']['id'];
        $reservation->localizador_erp = $response['data']['reserva']['localizador'];
        $reservation->ubicacion_id = $response['data']['reserva']['ubicacion_id'];
        $reservation->checkin = $checkin;
        $reservation->checkout = $checkout;
        $reservation->apartment_id = $apartamento_id;
        $reservation->typology_id = $tipologia_id;
        $reservation->user_id = $user_id;
        $reservation->experience_id = $experiencia_id;
        $reservation->regimen_id = $package_id;
        $reservation->policy_id = $response['data']['reserva']['politica_cancelacion']['id'];
        $reservation->promotion_id = $response['data']['reserva']['promocion_id'];
        $reservation->adults = $response['data']['reserva']['adultos'];
        $reservation->kids = $response['data']['reserva']['ninos'];
        $reservation->amount = $response['data']['reserva']['total_reserva'];
        $reservation->payment_id = $response['data']['payment_id'];
        $reservation->save();

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
            'ubicacion_id' => 'required|numeric',
            'fecha_entrada' => 'required|date_format:Y-m-d',
            'fecha_salida' => 'required|date_format:Y-m-d',
            'tipologia_id' => 'required|numeric',
            'apartamento_id' => 'required|numeric',
            'cliente_email' => 'required|email',
            'cliente_nombre' => 'required',
            'cliente_apellido' => 'required',
            //'cliente_cif' => 'required',
            'cliente_telefono' => 'required',
            //'cliente_pais' => 'required|regex:/^[A-Z]{2}$/',
            //'cliente_calle' => 'required',
            //'cliente_numero' => 'required',
            //'cliente_piso' => 'required',
            //'cliente_cpostal' => 'required',
            //'cliente_ciudad' => 'required',
            'experiencia_id' => 'required|numeric',
            'regimen_id' => 'required|numeric',
            'politica_id' => 'required|numeric',
            'promocion_id' => 'required|numeric',
            'adultos' => 'required|numeric',
            'ninos' => 'required|numeric',
            //'user_id' => 'required|numeric',
        ];
    }

}