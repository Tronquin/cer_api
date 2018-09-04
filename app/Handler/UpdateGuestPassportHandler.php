<?php
namespace App\Handler;


use App\Service\ERPService;

class UpdateGuestPassportHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::updateGuestPassport($this->params['data']);

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
            'id' =>'required|numeric',
            'tipo_documento' =>'required',
            'apellido1' =>'required',
            'apellido2' =>'required',
            'nombre' =>'required',
            'pais' =>'required',
            'fecha_nacimiento' =>'required',
            'sexo' =>'required',
        ];
    }

}