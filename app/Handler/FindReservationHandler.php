<?php
namespace App\Handler;

use App\ReservationPersistence;
use App\Service\ERPService;
use App\Service\MachineLogService;

class FindReservationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::findReservation($this->params);
        $reservation_persistence = ReservationPersistence::where('reserva_id','=',$response['data']['list'][0]['id'])->first();
        $response['data']['list'][0]['hasCheckinMovil'] = 0;
        if($reservation_persistence){
            $response['data']['list'][0]['hasCheckinMovil'] = $reservation_persistence->has_checkin_movil;
        }

        $param = $this->params['numberCodeOrName'];
        $count = $response['res'];
        MachineLogService::log($this->oAuth2Client->machine->id,
            "Busqueda de reserva para '{$param}', {$count} resultados obtenidos"
        );

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
            'numberCodeOrName' =>'required',
            'ubicacion_id' => 'required|numeric',
        ];
    }

}