<?php
namespace App\Handler;

use App\Reservation;
use App\ReservationFeedback;
use App\Service\EmailService;
use App\Service\ERPService;

class ReservationFeedbackHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $feedback = new ReservationFeedback();
        $feedback->reserva_id = !empty($this->params['data']['reserva_id']) ? $this->params['data']['reserva_id'] : null;
        $feedback->puntuacion = !empty($this->params['data']['puntuacion']) ? $this->params['data']['puntuacion'] : null;
        $feedback->comentario = !empty($this->params['data']['comentario']) ? $this->params['data']['comentario'] : '';
        $feedback->save();

       $response = ERPService::feedback([
           'reservation_id' => !empty($this->params['data']['reserva_id']) ? $this->params['data']['reserva_id'] : null,
           'value' => !empty($this->params['data']['puntuacion']) ? $this->params['data']['puntuacion'] : -1,
           'comment' => !empty($this->params['data']['comentario']) ? $this->params['data']['comentario'] : ''
       ]);

       $reservation_instance = Reservation::where('localizador_erp', $reservation['localizador'])->first();
       $iso = $reservation_instance->iso;

       if ($feedback->reserva_id) {
           $reservation = Reservation::query()->where('reserva_id_erp', $feedback->reserva_id)->first();
           $recipients = [$reservation->user->email];
           EmailService::send('email.rateService', 'Valoración de reserva', $recipients, compact('iso'));
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

        ];
    }


}