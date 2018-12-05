<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use App\Handler\GeneralHandlers\FindExperiencesByLocationHandler;
use App\Experience;

class FindApartmentsDisponibilityHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findApartmentsDisponibility($this->params['data']);

        foreach($response['data'] as &$data){
            $experiences = new FindExperiencesByLocationHandler(['ubicacion_id' => $data['tipologia']['ubicacion_id']]);
            $experiences->processHandler();
            $experiencias = $experiences->getData();
            $data['tipologia']['experiencias'] = $experiencias['data'];
        }
        
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
            'adults' => 'required|numeric',
            'kids' => 'required|numeric',
        ];
    }

}