<?php
namespace App\Handler;


use App\ReservationServicePersistence;

class DeleteServiceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $service_persistence = ReservationServicePersistence::where('reserva_id', '=', $this->params['reserva_id'])->delete();

        return $service_persistence;
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
            'funcion' =>'required',
        ];
    }

}