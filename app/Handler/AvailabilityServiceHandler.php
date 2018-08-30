<?php
namespace App\Handler;


use App\Service\ERPService;

class AvailabilityServiceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $dataService =[
            'reserva_id' => $this->params['reserva_id'],
            'funcion' => $this->params['funcion'],
        ];
        $response = ERPService::availabilityService($dataService);

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
            'reserva_id' =>'required|numeric',
            'funcion' =>'required',
        ];
    }

}