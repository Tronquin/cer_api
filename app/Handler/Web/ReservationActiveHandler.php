<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Reservation;
use App\Experience;
use App\User;

class ReservationActiveHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $response['res'] = 0;
        $response['msg'] = 'No se encontraron reservas activas';
        $response['data'] = [];

        $user = User::where('email',$this->params['email'])->first();
        if(!$user)
        return 'user not found';

        $data = Reservation::where('user_id',$user->id)->get();
        
        if(count($data)){
            foreach ($data as &$dato){ 
                $dato['experiencia'] = Reservation::find($dato['id'])->experience;
                $dato['user'] = Reservation::find($dato['id'])->user;
            }
            $response['res'] = count($data);
            $response['msg'] = 'Reservas activas';
            $response['data'] = $data;
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
            'email' => 'required',
        ];
    }

}