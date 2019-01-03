<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Handler\AvailabilityServiceHandler;
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
                $dato['experiencia'] = Experience::where('id',$dato['experience_id'])->with(['extras'])->first();
                $dato['experiencia']['fieldTranslations'] = $dato['experiencia']->fieldTranslations();
                foreach($dato['experiencia']['extras'] as &$extra){
                    $extra['fieldTranslations'] = $extra->fieldTranslations();
                }
                $dato['user'] = Reservation::find($dato['id'])->user;
                $dato['cancelation_policy'] = Reservation::find($dato['id'])->cancelation_policy;
                $dato['packages'] = Reservation::find($dato['id'])->package;
                $dato['promotion'] = Reservation::find($dato['id'])->promotion;

                $handler = new AvailabilityServiceHandler(['reserva_id' => $dato['reserva_id_erp'],'funcion' => 'checkin']);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    $extras_contratados = $handler->getData();
                    $dato['extras_contratados'] = $extras_contratados['data']['list']['extras']['extras_contratados'];
                }
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