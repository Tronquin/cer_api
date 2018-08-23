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
        $data['data']['list']['mejoraService'] = [];

        $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $tipologia = $handler->getData();
        }else{
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }
        if($reservation_persistence['tipologia_id'] != ''){
            foreach ($tipologia['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['tipologia_id']){
                    $data['data']['list']['mejoraApartamento'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            unset($data['mejoraApartamento']);
        }
        $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $planes = $handler->getData();
        }else{
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }
        if($reservation_persistence['plan_id'] != ''){
            foreach ($planes['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['plan_id']){
                    $data['data']['list']['mejoraPlan'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            unset($data['mejoraPlan']);
        }
        $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['reserva_id']]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $experiences = $handler->getData();
        }else{
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }
        if($reservation_persistence['experience_id'] != ''){
            foreach ($experiences['data']['list'] as $valid => $key){
                if ($key['id'] == $reservation_persistence['experience_id']){
                    $data['data']['list']['mejoraExperience'] = $key;
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            unset($data['mejoraExperience']);
        }
        $handler = new AvailabilityServiceHandler(['reserva_id' => $this->params['reserva_id'],'funcion' => 'checkin']);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $services = $handler->getData();
        }else{
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }

        if($reservation_persistence['services'] != ''){
            foreach ($services['data']['list']['extras_contratados'] as $valid => $key){
                array_push($data['data']['list']['mejoraService'],$key);
            }
            $servicesAdd = json_decode($reservation_persistence['services'],true);

            foreach ($services['data']['list']['extras_disponibles'] as $valid => $key){
                foreach ($servicesAdd as $index => $keyService){
                    if($keyService['id'] == $key['id']){
                        array_push($data['data']['list']['mejoraService'],$key);
                    }
                }
            }
            $data['res'] = $data['res'] + 1;
        }else{
            if($services['data']['list']['extras_contratados']){
                foreach ($services['data']['list']['extras_contratados'] as $valid => $key){
                    array_push($data['data']['list']['mejoraService'],$key);
                }
                $data['res'] = $data['res'] + 1;
            }else{
                unset($data['list']['mejoraService']);
            }
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