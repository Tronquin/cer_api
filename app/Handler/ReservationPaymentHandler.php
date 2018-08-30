<?php
namespace App\Handler;


use App\Service\ERPService;

class ReservationPaymentHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::reservationPayment($this->params['data']);

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
            'plan_id' =>'required|numeric',
            'tipologia_id' =>'required|numeric',
            'experience_id' =>'required|numeric',
            'kids' =>'required|numeric',
            'adults' =>'required|numeric',
            'total' =>'required|numeric',
        ];
    }

}