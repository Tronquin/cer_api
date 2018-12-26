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

        $data = Reservation::where('user_id',$this->params['user_id'])->get();
        
        if(count($data)){
            foreach ($data as &$dato){ 
                $dato['experiencia'] = Experience::find($dato['experience_id']);
                $dato['user'] = User::find($dato['user_id']);
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
            'user_id' => 'required|numeric',
        ];
    }

}