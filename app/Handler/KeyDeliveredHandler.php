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

        if ($key_delivered) {
            $key_delivered->keys_delivered = $response['data']['llaves_entregadas'];
            $sql = $key_delivered->save();

            if($sql != true)return $sql;
        }else{
            $key_delivered = new ReservationKey();
            $key_delivered->reserva_id = $this->params['data']['reserva_id'];
            $key_delivered->keys_delivered = $response['data']['llaves_entregadas'];
            $sql = $key_delivered->save();

            if($sql != true)return $sql;
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