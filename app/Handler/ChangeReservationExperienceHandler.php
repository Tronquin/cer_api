<?php
namespace App\Handler;

use App\Service\ERPService;

class ChangeReservationExperienceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::changeReservationExperience($this->params);

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