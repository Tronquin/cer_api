<?php
namespace App\Handler;

use App\ReservationPersistence;

class ReservationHasCheckinMovilHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = 'no existe';
        $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['reserva_id'])->where('status_id','=',1)->first();
        if ($reservation_persistence){
            $reservation_persistence->has_checkin_movil = true;
            $reservation_persistence->save();
            $response = $reservation_persistence;
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
        ];
    }


}