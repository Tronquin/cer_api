<?php
namespace App\Handler\UsersHandlers;

use App\Reservation;
use App\Session;
use App\Handler\BaseHandler;

class ReservationAsociateUserHandler extends BaseHandler {

    /**
     * Handler que asocia un usuario a las reservas registradas sin session
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];

        $reservaciones = Reservation::where('localizador_erp',$this->params['localizador'])
                                    ->where('user_id', null)
                                    ->where('no_session_user_id',1)->get();

        if(count($reservaciones) < 1) $response = ['res' => 0, 'msg' => 'No existen registros con este localizador','data' => []];

        $usuario = Session::where('token',$this->params['token'])->first();
        if (!$usuario) $response = ['res' => 0, 'msg' => 'Usuario no encontrado','data' => []];

        foreach ($reservaciones as &$reservation) {
            $reservation->user_id = $usuario->user_id;
            $reservation->save();
        }

        return $response = ['res' => 1, 'msg' => 'Operacion realizada exitosamente', 'data' => $reservaciones];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'user_id' => 'required|numeric',
            'localizador' => 'required',
        ];
    }

}