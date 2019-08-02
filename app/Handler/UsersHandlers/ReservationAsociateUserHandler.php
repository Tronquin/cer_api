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
                                    ->where('no_session_user_id','<>',null)
                                    ->where('no_session_user_id','<>',0)->get();

        if(count($reservaciones) < 1) return $response = ['res' => 0, 'msg' => 'No existen registros libres de usuario con este localizador','data' => []];

        $usuario = Session::where('token',$this->params['session'])->first();
        if (!$usuario) return $response = ['res' => 0, 'msg' => 'Usuario no encontrado','data' => []];

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
            'session' => 'required',
            'localizador' => 'required',
        ];
    }

}