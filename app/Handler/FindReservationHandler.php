<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservation($this->params['numberOrName']);

        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [];
    }

}