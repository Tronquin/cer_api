<?php
namespace App\Handler;


use App\Service\ERPService;

class KeyDeliveredHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::keyDelivered($this->params['data']);

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
            'reserva_id' => 'required|numeric',
            'llaves_entregadas' =>'required|numeric',
        ];
    }

}