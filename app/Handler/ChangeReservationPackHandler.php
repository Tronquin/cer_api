<?php
namespace App\Handler;

use App\Service\ERPService;

class ChangeReservationPackHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::changeReservationPack($this->params);

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