<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationToCheckinHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservationToCheckin($this->params);

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
            'ubicacion_id' =>'required|numeric',
            'date' =>'required'
        ];
    }

}