<?php
namespace App\Handler;


use App\Service\ERPService;

class ScanGuestPassportHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::scanGuestPassport($this->params['data']);

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
            'file' =>'required',
        ];
    }

}