<?php
namespace App\Handler;

use App\Service\ERPService;

class ChangeReservationKeyHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::changeReservationKey($this->params);

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