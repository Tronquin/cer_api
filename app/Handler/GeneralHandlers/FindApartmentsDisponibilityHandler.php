<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;
use App\CancellationPolicy;
use App\SearchHistory;
use App\Service\ERPService;

class FindApartmentsDisponibilityHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $data = $this->params['data'];
        $ubicaciones = [];
        // Guardo historial de busqueda
        if(intval($data['ubicacion_id']) !== 0){
            $location = Location::query()->where('ubicacion_id', $data['ubicacion_id'])->with('promocions')->first()->toArray();
            $ubicaciones['promocions'] = [];
            foreach($location['promocions'] as $pr => $promo){
                if($promo['activo'])
                $ubicaciones['promocions'][] = $promo;
            }
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
                if(!isset($location)){
                    $ubicaciones['promocions'] = [];
                    $location = Location::query()->where('ubicacion_id', $ubication['id'])->with('promocions')->first()->toArray();
                    foreach($location['promocions'] as $pr => $promo){
                        if($promo['activo'])
                        $ubicaciones['promocions'][] = $promo;
                    }
                }
                $tipologiaW = [];
                foreach ($ubication['disponibility']['tipologias'] as $tipologia){
                    $experiences = new FindExperiencesByLocationHandler(['ubicacion_id' => $tipologia['ubicacion_id']]);
                    $experiences->processHandler();
                    $experiencias = $experiences->getData();
                    $ubication['experiencias'] = $experiencias['data'];
                    foreach ($ubication['experiencias'] as &$experiencia){
                        foreach($ubication['disponibility']['experiencias'] as $exp){
                            if($experiencia['experiencia_id'] === $exp['id']){
                                if($location['ubicacion_id'] !== 5){
                                    $experiencia['precio_upgrade'] = $exp['precio_upgrade'];
                                    $experiencia['precio_desglosado'] = $exp['precio_desglosado'];
                                }else{
                                    $experiencia['precio_upgrade'] = 0;
                                    $experiencia['precio_desglosado'] = 0;
                                }
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
                                if($location['ubicacion_id'] !== 5){
                                    $pack['precio_upgrade'] = $tarifa['precio_upgrade'];
                                    $pack['precio_desglosado'] = $tarifa['precio_desglosado'];
                                }else{
                                    $pack['precio_upgrade'] = 0;
                                    $pack['precio_desglosado'] = 0;
                                }
                            }
                        }
                    }

                    $ubication['promocions'] = $ubicaciones['promocions'];  
                    $cancelation_policy = [];
                    foreach($ubication['disponibility']['politicas'] as $pkey => $politicas){
                        $cancelation_policy[$pkey] = CancellationPolicy::query()->where('politica_cancelacion_id', $politicas['id'])->first()->toArray(); 
                        if($location['ubicacion_id'] !== 5){ 
                            $cancelation_policy[$pkey]['precio_desglosado']     =   $politicas['precio_desglosado'];
                            $cancelation_policy[$pkey]['precio_upgrade']     =   $politicas['precio_upgrade'];
                        }else{
                            $cancelation_policy[$pkey]['precio_desglosado']     =   0;
                            $cancelation_policy[$pkey]['precio_upgrade']     =   0;
                        }
                    }
                    $ubication['politica_cancelacions'] = $cancelation_policy;
                }
                $tipologia = [];
                $tipology = new FindTypologyByLocationHandler(['ubicacion_id' => $ubication['id']]);
                $tipology->processHandler();
                $tipologia = $tipology->getData();
                $ubication['tipologias'] = [];
                $validTipologia = [];
                foreach ($tipologia['data'] as $tkey => $tip) {
                    foreach ($ubication['disponibility']['tipologias'] as $t){
                        if($tip['tipologia_id'] === $t['id']){
                            $tip['dormitorios'] = $t['dormitorios'];
                            $tip['lavabos'] = $t['lavabos'];
                            if($location['ubicacion_id'] !== 5){ 
                                $tip['precio_upgrade'] = $t['precio_upgrade'];
                                $tip['precio_desglosado'] = $t['precio_desglosado'];
                            }else{
                                $tip['precio_upgrade'] = 0;
                                $tip['precio_desglosado'] = 0;
                            }
                            $tip['noches'] = $t['noches'];
                            $validTipologia[] = $tip;
                        }
                    }
                }
                $ubication['tipologias'] = $validTipologia;
                $ubication['tarifas'] = $ubication['disponibility']['rate_tarifas'];
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