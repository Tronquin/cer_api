<?php
namespace App\Handler;


use App\Service\ERPService;

class ChangeReservationServiceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::changeReservationService($this->params);

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

        ];
    }

}