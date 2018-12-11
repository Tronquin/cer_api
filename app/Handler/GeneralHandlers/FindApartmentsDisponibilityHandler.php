<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use App\Handler\GeneralHandlers\FindExperiencesByLocationHandler;
use App\Handler\GeneralHandlers\FindPackagesByLocationHandler;
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

            $packages = new FindPackagesByLocationHandler(['ubicacion_id' => $data['tipologia']['ubicacion_id']]);
            $packages->processHandler();
            $packs = $packages->getData();
            $data['tipologia']['packages'] = $packs['data'];

            $ubicaciones = ERPService::findUbicacionData(['ubicacion_id' => $data['tipologia']['ubicacion_id']]);
            $data['tipologia']['politica_cancelacions'] = $ubicaciones['politica_cancelacions'];
            $data['tipologia']['promocions'] = $ubicaciones['promocions'];
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