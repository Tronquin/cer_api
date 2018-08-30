<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservation($this->params);

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
            'numberCodeOrName' =>'required',
            'ubicacion_id' => 'required|numeric',
        ];
    }

}