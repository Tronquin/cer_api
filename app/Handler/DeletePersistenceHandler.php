<?php
namespace App\Handler;


use App\ReservationGuestPersistence;
use App\ReservationPersistence;
use App\ReservationServicePersistence;

class DeletePersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        ReservationPersistence::where('reserva_id','=',$this->params['reserva_id'])->update(['status_id' => $this->params['status_id']]);
        ReservationGuestPersistence::where('reserva_id', $this->params['reserva_id'])->update(['status_id' => $this->params['status_id']]);
        ReservationServicePersistence::where('reserva_id', $this->params['reserva_id'])->update(['status_id' => $this->params['status_id']]);

        return true;
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