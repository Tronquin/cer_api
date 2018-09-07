<?php
namespace App\Handler;


use App\ReservationPersistence;

class DeletePersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['reserva_id'])->first();
        if(count($reservation_persistence) > 0){
            $response = $reservation_persistence->delete();
        }else{
            $response = 'no se encontro persistencia para la reserva';
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
        ];
    }

}