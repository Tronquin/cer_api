<?php
namespace App\Handler;

use App\ReservationServicePersistence;

class ReservationServicePersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $service_persistence = ReservationServicePersistence::where('reserva_id', '=', $this->params['data']['reserva_id'])->delete();

        if ($this->params['data']['extras'] != null){
            foreach ($this->params['data']['extras'] as $extras) {
                $service_persistence = new ReservationServicePersistence();

                $service_persistence->reserva_id = $this->params['data']['reserva_id'];
                $service_persistence->extra_id = $extras['id'];
                $service_persistence->cantidad = $extras['cantidad'];

                $response = $service_persistence->save();

                if($response != true)break;

            }
            return $response;
        }
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
        ];
    }

}