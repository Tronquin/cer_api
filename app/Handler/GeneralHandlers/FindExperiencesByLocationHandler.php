<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Service\ERPService;

class FindExperiencesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $data = ERPService::findUbicacionData(['ubicacion_id' => $this->params['ubicacion_id']]);

        $response['res'] = '1';
        $response['msg'] = 'Experiencias de la ubicacion '.$this->params['ubicacion_id'];
        $response['data'] = $data['experiencias'];

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
            'ubicacion_id' => 'required|numeric',
        ];
    }

}