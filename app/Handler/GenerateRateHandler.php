<?php
namespace App\Handler;


use App\Service\ERPService;

class GenerateRateHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::generateRate($this->params['data']);

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
            'adults' =>'required|numeric',
            'kids' =>'required|numeric'
        ];
    }

}