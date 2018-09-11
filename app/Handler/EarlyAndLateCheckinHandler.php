<?php
namespace App\Handler;


use App\Service\ERPService;

class EarlyAndLateCheckinHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::earlyAndLateCheckin($this->params);

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
            'reserva_id' =>'required|numeric'
        ];
    }

}