<?php
namespace App\Handler;


use App\Service\ERPService;

class AddReservationServiceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::addReservationService($this->params['data']);

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
            'extras' =>'required',
            'pago_extras' =>'required|numeric',

        ];
    }

}