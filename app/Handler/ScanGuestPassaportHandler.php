<?php
namespace App\Handler;


use App\Service\ERPService;

class ScanGuestPassaportHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::scanGuestPassaport($this->params['data']);

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