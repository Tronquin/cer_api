<?php
namespace App\Handler;


use App\ReservationPersistence;
use App\Service\ERPService;
use App\Status;
use App\Mail\BaseMail;
use Illuminate\Support\Facades\Mail;
use App\Handler\AvailabilityServiceHandler;
use App\Handler\FindExperiencesHandler;

class CheckoutHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::setCheckout(['reserva_id' => $this->params['data']['reserva_id']]);

        if (intval($response['res']) === 1) {
            // Cambia el estatus de la reserva a chechout

            $reservation = ReservationPersistence::where('reserva_id', $this->params['data']['reserva_id'])->first();
            $status = Status::where('code', ReservationPersistence::STATUS_CHECKOUT)->first();
            if($reservation){
                $reservation->status_id = $status->id;
                $reservation->save();
            }
        }
        $handler = new FindExperienceHandler(['experiencia_id' => $response['data']['reserva']['experiencia']['id']]);
        $handler->processHandler();
        
        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => 'error para obtener los datos de la experiencia',
            ];
        }
        $experiencia = $handler->getData();
        $handler = new AvailabilityServiceHandler(['reserva_id' => $this->params['data']['reserva_id'],'funcion' => 'checkin']);
        $handler->processHandler();
        
        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => 'error para obtener los extras contratados',
            ];
        }
        $servicios = $handler->getData();
        
        $data['reserva']['extras_contratados'] = $servicios['data']['list']['extras']['extras_contratados'];
        $total = 0;
        foreach($data['reserva']['extras_contratados'] as &$extra){
            $extra['precio']['total'] = round($extra['precio']['total']);
            $total = $total + ($extra['precio']['total'] * $extra['cantidad']);
        }
        $data['experiencia'] = $experiencia['data'];
        $data['total_reserva'] = $response['data']['reserva']['total_reserva'];
        $data['reserva']['total_extras_contratados'] = $total;
        $data['lang'] = $this->params['data']['iso'];
        
        $emailInstance = new BaseMail('email.checkout', [$response['data']['reserva']['cliente']['email']], ['data' => $data]);

        Mail::send($emailInstance);

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
            'reserva_id' =>'required',
        ];
    }

}