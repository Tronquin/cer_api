<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;
use App\SearchHistory;
use App\Service\ERPService;

class FindApartmentsDisponibilityHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $data = $this->params['data'];

        // Guardo historial de busqueda
        $location = Location::query()->where('ubicacion_id', $data['ubicacion_id'])->first();

        $searchHistory = new SearchHistory();
        $searchHistory->start_date = new \DateTime($data['desde']);
        $searchHistory->end_date = new \DateTime($data['hasta']);
        $searchHistory->location_id = $location->id;
        $searchHistory->adults = $data['adults'];
        $searchHistory->kids = $data['kids'];
        $searchHistory->apartments = $data['apartments'];
        $searchHistory->save();

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
            'apartments' => 'required|numeric',
        ];
    }

}