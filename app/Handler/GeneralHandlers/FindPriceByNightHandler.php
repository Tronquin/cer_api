<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Service\ERPService;

class FindPriceByNightHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findPriceByNight($this->params['data']);

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
            'desde' => 'required',
            'hasta' => 'required',
            'ubicacion_id' => 'required|numeric',
            'tipologia_id' => 'required|numeric',
            'experiencia_id' => 'required|numeric',
            'regimen_id' => 'required|numeric',
            'promocion_id' => 'required|numeric',
            'politica_id' => 'required|numeric',
        ];
    }

}