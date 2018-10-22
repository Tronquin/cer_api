<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationByKeyHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        
        $response = ERPService::getReservationByKey($this->params);

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
            'key' =>'required',
        ];
    }

}