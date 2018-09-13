<?php
namespace App\Handler;


use App\Service\ERPService;

class ApartmentDisponibilityHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::apartmentDisponibility($this->params);

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
            'reserva_id' => 'required|numeric',
            'apartamento_id' =>'required|numeric',
        ];
    }

}