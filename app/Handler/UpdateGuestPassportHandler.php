<?php
namespace App\Handler;


use App\Service\ERPService;

class UpdateGuestPassportHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::updateGuestPassport($this->params['data']['huesped']);

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
            'huesped' =>'required',
        ];
    }

}