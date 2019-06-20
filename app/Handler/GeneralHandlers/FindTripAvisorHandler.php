<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Tripavisor;
use App\Service\UrlGenerator;

class FindTripAvisorHandler extends BaseHandler {

    protected $cache = true;

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiences = [];

        $tripavisorData = Tripavisor::query()->get();

        $response['res'] = count($tripavisorData);
        $response['msg'] = 'datos encontrados';
        $response['data'] = $tripavisorData;
       
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
            
        ];
    }

}