<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Service\ERPService;

class FindApartmentsByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $data = ERPService::findApartmentsByLocation(['ubicacion_id' => $this->params['ubicacion_id']]);
        $response['res'] = 1;
        $response['msg'] = 'Apartamentos encontrados para la ubicacion '.$this->params['ubicacion_id'];
        $response['data'] = $data['apartamentos'];

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