<?php
namespace App\Handler;

use App\ReservationGuestPersistence;
use App\Service\ERPService;

class ReservationFindGuestPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $guest_persistence = ReservationGuestPersistence::where('reserva_id','=',$this->params['reserva_id'])->get();

        $data=[];
        $components = "";
        $data['res'] = 0;
        $data['msg'] = 'huespedes de la reserva';
        if (count($guest_persistence) > 0) {
            $data['data']['list'] = $guest_persistence;
        }else{
            $data['data']['list'] = new \stdClass;
        }

        return $data;
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