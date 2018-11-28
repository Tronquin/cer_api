<?php
namespace App\Handler;


use App\ReservationPersistence;
use App\Service\ERPService;
use App\Status;

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