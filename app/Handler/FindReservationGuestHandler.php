<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationGuestHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservationGuest($this->params['numberCodeOrName']);

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