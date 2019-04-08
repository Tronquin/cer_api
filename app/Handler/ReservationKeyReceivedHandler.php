<?php
namespace App\Handler;

use App\Reservation;
use App\ReservationKey;
use App\Service\MachineLogService;

class ReservationKeyReceivedHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $key_delivered = ReservationKey::where('reserva_id', '=', $this->params['data']['reserva_id'])->first();

        if (count($key_delivered) > 0){
            $key_delivered->keys_received = $this->params['data']['llaves_recibidas'];
            $key_delivered->keys_delivered = $key_delivered->keys_delivered - $this->params['data']['llaves_recibidas'];

            $response = $key_delivered->save();
        }else{
            $key_delivered = new ReservationKey();
            $key_delivered->reserva_id = $this->params['data']['reserva_id'];
            $key_delivered->keys_received = $this->params['data']['llaves_recibidas'];
            $key_delivered->keys_delivered = $key_delivered->keys_delivered - $this->params['data']['llaves_recibidas'];

            $response = $key_delivered->save();
        }

        $reservation = $this->params['data']['reserva_id'];

        MachineLogService::log($this->oAuth2Client->machine->id,
            "Recibidas {$key_delivered->keys_received} llaves en la reserva en la reserva '{$reservation}'"
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
            'reserva_id' => 'required|numeric',
            'llaves_recibidas' => 'required|numeric',
        ];
    }

}