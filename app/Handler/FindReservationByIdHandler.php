<?php
namespace App\Handler;

use App\ReservationPersistence;
use App\Service\ERPService;

class FindReservationByIdHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservationById($this->params);
        $reservation_persistence = ReservationPersistence::where('reserva_id','=',$response['data']['list']['id'])->first();
        $response['data']['list']['hasCheckinMovil'] = 0;
        if($reservation_persistence){
            $response['data']['list']['hasCheckinMovil'] = $reservation_persistence->has_checkin_movil;
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