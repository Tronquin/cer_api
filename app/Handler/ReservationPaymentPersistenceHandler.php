<?php
namespace App\Handler;

use App\ReservationPaymentPersistence;
use App\Service\ERPService;

class ReservationPaymentPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $payment_persistence = new ReservationPaymentPersistence();
        $payment_persistence->reserva_id = $this->params['data']['reserva_id'];
        $payment_persistence->payment = json_encode($this->params['data']['payment']);
        $response = $payment_persistence->save();

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
            'reserva_id' =>'required|numeric',
            'payment' =>'required',
        ];
    }

}