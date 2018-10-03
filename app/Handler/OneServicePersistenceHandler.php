<?php
namespace App\Handler;

use App\ReservationServicePersistence;
use App\Service\ERPService;

class OneServicePersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::addReservationService($this->params['data']);

        foreach ($this->params['data']['extras'] as $extras) {

            $service_persistence = new ReservationServicePersistence();

            $service_persistence->reserva_id = $this->params['data']['reserva_id'];
            $service_persistence->extra_id = $extras['id'];
            $service_persistence->cantidad = $extras['cantidad'];

            $service_persistence->save();
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
            'reserva_id' =>'required|numeric',
            'extras' =>'required',
        ];
    }

}