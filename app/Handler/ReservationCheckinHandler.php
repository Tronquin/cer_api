<?php
namespace App\Handler;

use App\Service\ERPService;

class ReservationCheckinHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::reservationCheckin($this->params['reserva_id']);

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