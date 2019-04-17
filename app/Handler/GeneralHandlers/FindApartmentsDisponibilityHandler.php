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
        if(intval($data['ubicacion_id']) !== 0){
            $location = Location::query()->where('ubicacion_id', $data['ubicacion_id'])->first()->toArray();
    
            $searchHistory = new SearchHistory();
            $searchHistory->start_date = new \DateTime($data['desde']);
            $searchHistory->end_date = new \DateTime($data['hasta']);
            $searchHistory->location_id = $location['id'];
            $searchHistory->adults = $data['adults'];
            $searchHistory->kids = $data['kids'];
            $searchHistory->apartments = $data['apartments'];
            $searchHistory->save();
        }

        $response = ERPService::findApartmentsDisponibility($this->params['data']);
        //dump($response);
        if($response['data'] !== ''){
            foreach ($response['data'] as $key => &$ubication){
                $tipologiaW = [];
                foreach ($ubication['disponibility']['tipologias'] as $tipologia){
                    $experiences = new FindExperiencesByLocationHandler(['ubicacion_id' => $tipologia['ubicacion_id']]);
                    $experiences->processHandler();
                    $experiencias = $experiences->getData();
                    $ubication['experiencias'] = $experiencias['data'];
                    foreach ($ubication['experiencias'] as &$experiencia){
                        foreach($ubication['disponibility']['experiencias'] as $exp){
                            if($experiencia['experiencia_id'] === $exp['id']){
                                $experiencia['precio_upgrade'] = $exp['precio_upgrade'];
                            }
                        }
                    }
    
                    $packages = new FindPackagesByLocationHandler(['ubicacion_id' => $tipologia['ubicacion_id']]);
                    $packages->processHandler();
                    $packs = $packages->getData();
                    $ubication['packages'] = $packs['data'];
                    foreach ($ubication['packages'] as &$pack){
                        foreach($ubication['disponibility']['tarifas'] as $tarifa){
                            if($pack['tarifa_id'] === $tarifa['id']){
                                $pack['precio_upgrade'] = $tarifa['precio_upgrade'];
                            }
                        }
                    }

                    $ubicaciones = ERPService::findUbicacionData(['ubicacion_id' => $tipologia['ubicacion_id']]);
                    //$tipologia['politica_cancelacions'] = $ubicaciones['politica_cancelacions'];
                    $ubication['politica_cancelacions'] = $ubication['disponibility']['politicas'];
                    $ubication['promocions'] = $ubicaciones['promocions'];            
                }
                $tipologia = [];
                $tipology = new FindTypologyByLocationHandler(['ubicacion_id' => $ubication['id']]);
                $tipology->processHandler();
                $tipologia = $tipology->getData();
                $ubication['tipologias'] = [];
                foreach ($tipologia['data'] as $tkey => $tip) {
                    foreach ($ubication['disponibility']['tipologias'] as $t){
                        if($tip['tipologia_id'] === $t['id']){
                            $tip['dormitorios'] = $t['dormitorios'];
                            $tip['lavabos'] = $t['lavabos'];
                            $tip['precio_upgrade'] = $t['precio_upgrade'];
                        }
                    }
                    $ubication['tipologias'][$tkey] = $tip;
                }
                unset($response['data'][$key]['disponibility']);
            }
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