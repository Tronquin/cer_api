<?php
namespace App\Handler;


use App\Service\ERPService;
use App\ReservationKey;

class KeyDeliveredHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::keyDelivered($this->params['data']);
        $key_delivered = ReservationKey::where('reserva_id', '=', $this->params['data']['reserva_id'])->first();

        if (count($key_delivered) > 0) {
            $key_delivered->Keys_delivered = $response['data']['llaves_entregadas'];
        }else{
            $keyDelivered = new ReservationKey();
            $keyDelivered->reserva_id = $this->params['data']['reserva_id'];
            $keyDelivered->Keys_delivered = $response['data']['llaves_entregadas'];
            $keyDelivered->Keys_received = 0;
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
            'llaves_entregadas' =>'required|numeric',
        ];
    }

}