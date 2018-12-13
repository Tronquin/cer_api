<?php
namespace App\Handler;

use App\Reservation;
use App\User;

/**
 * Obtiene el historial de reservas de un usuario
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class ReservationHistoryHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $user = User::where('email', $this->params['email'])->firstOrFail();
        $reservations = Reservation::where('user_id', $user->id)
            ->with(['typology', 'user', 'experience', 'package'])
            ->orderBy('created_at', 'DESC')
            ->get()
        ;

        foreach ($reservations as $reservation) {
            $reservation->checkinWeekDay = $reservation->checkin->format('l');
            $reservation->checkoutWeekDay = $reservation->checkout->format('l');
        }

        return [
            'res' => count($reservations),
            'msg' => 'Historial de reservas usuario: ' . $user->email,
            'data' => $reservations
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'email' => 'required|email'
        ];
    }

}