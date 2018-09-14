<?php
namespace App\Handler;

use App\Service\ERPService;
use App\ReservationFeedback;

class ReservationFeedbackHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $feedback = ReservationFeedback::where('reserva_id', '=', $this->params['data']['reserva_id'])->delete();
        $feedback = new ReservationFeedback();

        $feedback->reserva_id = $this->params['data']['reserva_id'];
        $feedback->puntuacion = $this->params['data']['puntuacion'];
        $feedback->comentario = "";
        if($this->params['data']['puntuacion'] < 5){
            $feedback->comentario = $this->params['data']['comentario'];
        }

        $response = $feedback->save();

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