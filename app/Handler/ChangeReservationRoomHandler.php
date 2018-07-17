<?php
namespace App\Handler;

use App\Service\ERPService;

class ChangeReservationRoomHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::changeReservationRoom($this->params);

        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {

    }


}