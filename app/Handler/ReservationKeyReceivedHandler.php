<?php
namespace App\Handler;

use App\ReservationKey;

class ReservationKeyReceivedHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $key_delivered = ReservationKey::where('reserva_id', '=', $this->params['data']['reserva_id'])->first();

        if (count($key_delivered) > 0){
            $key_delivered->keys_received = $this->params['data']['keys_received'];
            $key_delivered->keys_delivered = $key_delivered->keys_delivered - $this->params['data']['keys_received'];

            $response = $key_delivered->save();
        }else{
            $key_delivered = new ReservationKey();
            $key_delivered->reserva_id = $this->params['data']['reserva_id'];
            $key_delivered->keys_received = $this->params['data']['keys_received'];
            $key_delivered->keys_delivered = $key_delivered->keys_delivered - $this->params['data']['keys_received'];

            $response = $key_delivered->save();
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
            'keys_received' => 'required|numeric',
        ];
    }

}