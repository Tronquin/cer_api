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
        $components = "";
        $data['res'] = 0;
        $data['msg'] = 'persistencia de la reserva';

        if($reservation_persistence['adults'] != '' && $reservation_persistence['kids'] != ''){
            $data['data']['list']['mejoraPax']['adults'] = $reservation_persistence['adults'];
            $data['data']['list']['mejoraPax']['kids'] = $reservation_persistence['kids'];

            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraPax'] = [];
        }

        $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $tipologia = $handler->getData();
        }else{
            $data['msg'] = $handler->getStatusCode();
            $data['data'] = $handler->getErrors();
            return $data;
        }
        if($reservation_persistence['tipologia_id'] != ''){
            foreach ($tipologia['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['tipologia_id']){
                    $data['data']['list']['mejoraApartamento'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraApartamento'] = [];
        }
        $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $planes = $handler->getData();
        }else{
            $data['msg'] = $handler->getStatusCode();
            $data['data'] = $handler->getErrors();
            return $data;
        }
        if($reservation_persistence['plan_id'] != ''){
            foreach ($planes['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['plan_id']){
                    $data['data']['list']['mejoraPlan'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraPlan'] = [];
        }
        $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $experiences = $handler->getData();
        }else{
            $data['msg'] = $handler->getStatusCode();
            $data['data'] = $handler->getErrors();
            return $data;
        }
        if($reservation_persistence['experience_id'] != ''){
            foreach ($experiences['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['experience_id']){
                    $data['data']['list']['mejoraExperience'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            $data['data']['list']['mejoraExperience'] = [];
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

        ];
    }

}