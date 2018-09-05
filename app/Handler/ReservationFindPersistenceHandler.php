<?php
namespace App\Handler;

use App\ReservationPersistence;
use App\Service\ERPService;

class ReservationFindPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['reserva_id'])->first();

        $data=[];
        $data['res'] = 0;
        $data['msg'] = 'persistencia de la reserva';

        if($reservation_persistence['adults'] != '' && $reservation_persistence['kids'] != ''){
            $data['data']['list']['mejoraPax']['adults'] = $reservation_persistence['adults'];
            $data['data']['list']['mejoraPax']['kids'] = $reservation_persistence['kids'];

            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraPax'] = new \stdClass;
        }


        if($reservation_persistence['tipologia_id'] != ''){

            $data['data']['list']['mejoraTipologia']['id'] = $reservation_persistence['tipologia_id'];
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraTipologia'] = new \stdClass;
        }

        if($reservation_persistence['plan_id'] != ''){

            $data['data']['list']['mejoraPlan']['id'] = $reservation_persistence['plan_id'];
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraPlan'] = new \stdClass;
        }

        if($reservation_persistence['experience_id'] != ''){

            $data['data']['list']['mejoraExperience']['id'] = $reservation_persistence['experience_id'];
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraExperience'] = new \stdClass;
        }

        return $data;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'reserva_id' =>'required|numeric',
        ];
    }

}