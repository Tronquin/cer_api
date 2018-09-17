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

        if($response['res'] == 0){
            $room = ERPService::availabilityRoom($this->params);

            $response['data'] = $room;
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
            'reserva_id' => 'required|numeric',
            'apartamento_id' =>'required|numeric',
        ];
    }

}