<?php
namespace App\Handler;


use App\ReservationPersistence;
use App\Service\ERPService;

class ReservationPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $this->params['data']['reserva_id'],'method' => 2]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $reserva = $handler->getData();
        }else{
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }

            if($this->params['data']['type'] == 'pax'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();
                if (count($reservation_persistence) >= 1){
                    $tipologia = $reservation_persistence->tipologia_id != '' ? $reservation_persistence->tipologia_id : $reserva['data']['list']['tipologia']['id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $roomValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($roomValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $validMaxOfPeople = $valid['max'];
                        }
                    }
                    if ($validMaxOfPeople >= ($this->params['data']['adults']+$this->params['data']['kids']) && ($reserva['data']['list']['adultos'] != $this->params['data']['adults']) && ($reserva['data']['list']['ninos'] != $this->params['data']['kids'])) {
                        $reservation_persistence->adults = $this->params['data']['adults'];
                        $reservation_persistence->kids = $this->params['data']['kids'];
                        $response = $reservation_persistence->save();
                    }else{
                        $response = 'maximo de huespedes excedido';
                    }
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $tipologia = $reserva['data']['list']['tipologia']['id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $maxValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($maxValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $validMaxOfPeople = $valid['max'];
                        }
                    }
                    if ($validMaxOfPeople >= ($this->params['data']['adults']+$this->params['data']['kids']) && ($reserva['data']['list']['adultos'] != $this->params['data']['adults']) && ($reserva['data']['list']['ninos'] != $this->params['data']['kids'])) {
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->adults = $this->params['data']['adults'];
                    $reservation_persistence->kids = $this->params['data']['kids'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'maximo de huespedes excedido';
                    }
                }
            }elseif ($this->params['data']['type'] == 'room'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $tipologia = $reservation_persistence->tipologia_id != '' ? $reservation_persistence->tipologia_id : $reserva['data']['list']['tipologia']['id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $roomValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($roomValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['tipologia']['id'] != $this->params['data']['tipologia_id'])) {
                    $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Tipologia Invalida';
                    }
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $tipologia = $reserva['data']['list']['tipologia']['id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $roomValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($roomValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['tipologia']['id'] != $this->params['data']['tipologia_id'])) {
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Tipologia Invalida';
                    }
                }
            }elseif ($this->params['data']['type'] == 'plan'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $plan = $reservation_persistence->plan_id != '' ? $reservation_persistence->plan_id : $reserva['data']['list']['tarifa']['id'];
                    $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $planValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($planValidate['data']['list'] as $valid){
                        if ($valid['id'] == $plan){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['tarifa']['id'] != $this->params['data']['plan_id'])) {
                    $reservation_persistence->plan_id = $this->params['data']['plan_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Plan Invalido';
                    }
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $plan = $reserva['data']['list']['tarifa_id']['id'];
                    $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $planValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($planValidate['data']['list'] as $valid){
                        if ($valid['id'] == $plan){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['tarifa']['id'] != $this->params['data']['plan_id'])) {
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->plan_id = $this->params['data']['plan_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Plan Invalido';
                    }
                }
            }elseif ($this->params['data']['type'] == 'experience'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $experience = $reservation_persistence->experience_id != '' ? $reservation_persistence->experience_id : $reserva['data']['list']['experience_id']['id'];
                    $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $experiencelidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($experiencelidate['data']['list'] as $valid){
                        if ($valid['id'] == $experience){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['experiencie']['id'] != $this->params['data']['experience_id'])) {
                    $reservation_persistence->experience_id = $this->params['data']['experience_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Experiencia Invalida';
                    }
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $experience = $reservation_persistence->experience_id != '' ? $reservation_persistence->experience_id : $reserva['data']['list']['experience_id']['id'];
                    $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $experiencelidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($experiencelidate['data']['list'] as $valid){
                        if ($valid['id'] == $experience){
                            $ValidType = true;
                        }
                    }
                    if ($ValidType && ($reserva['data']['list']['experiencie']['id'] != $this->params['data']['experience_id'])) {
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->experience_id = $this->params['data']['experience_id'];
                    $response = $reservation_persistence->save();
                    }else{
                        $response = 'Experiencia Invalida';
                    }
                }
            }elseif ($this->params['data']['type'] == 'service'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $services = json_decode($reservation_persistence->services,true);

                    $newServices = [
                        'id' => $this->params['data']['services'][0]['id'],
                        'cantidad' => $this->params['data']['services'][0]['cantidad'],
                    ];
                    array_push($services, $newServices);
                    $reservation_persistence->services = json_encode($services);
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->services = json_encode($this->params['data']['services']);
                    $response = $reservation_persistence->save();
                }
            }else{
                $response = 'tipo de cambio no existe';
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