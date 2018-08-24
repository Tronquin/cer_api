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

                $validMaxOfPeople = 0;
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();
                if (count($reservation_persistence) > 0){
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

                    if ($validMaxOfPeople >= ($this->params['data']['adults']+$this->params['data']['kids']) && (($reserva['data']['list']['adultos'] != $this->params['data']['adults']) || ($reserva['data']['list']['ninos'] != $this->params['data']['kids']))) {
                        $reservation_persistence->adults = $this->params['data']['adults'] != '' ? $this->params['data']['adults'] : null;
                        $reservation_persistence->kids = $this->params['data']['kids'] != '' ? $this->params['data']['kids'] : null;
                    }else{
                        $response = 'maximo de huespedes excedido';
                        return $response;
                    }

                    $validType = false;
                    $tipologia = $this->params['data']['tipologia_id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $roomValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($roomValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $validType = ($valid['incidencia_porcentaje'] > $reserva['data']['list']['tipologia']['incidencia_porcentaje']) ? true : false;
                        }
                    }
                    if($this->params['data']['tipologia_id'] != ""){
                        if ($validType && ($reserva['data']['list']['tipologia']['id'] != $this->params['data']['tipologia_id'])) {
                            $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'] != "" ? $this->params['data']['tipologia_id'] : null;
                        }else{
                            $response = 'Tipologia Invalida';
                            return $response;
                        }
                    }

                    $validType = false;
                    $plan = $this->params['data']['plan_id'];
                    $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();
                    $actualPrice = $reserva['data']['list']['tarifa']['extra_id'] != 0 ? $reserva['data']['list']['tarifa']['extra']['base_imponible'] : 0;
                    if ($handler->isSuccess()) {
                        $planValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }

                    $validType = false;
                    foreach ($planValidate['data']['list'] as $valid){
                        if ($valid['id'] == $plan && $valid['extra']['base_imponible'] > $actualPrice){
                            $validType = true;
                        }
                    }
                    if($this->params['data']['plan_id'] != "") {
                        if ($validType && ($reserva['data']['list']['tarifa']['id'] != $this->params['data']['plan_id'])) {
                            $reservation_persistence->plan_id = $this->params['data']['plan_id'] != "" ? $this->params['data']['plan_id'] : null;
                        } else {
                            $response = 'Plan Invalido';
                            return $response;
                        }
                    }
                    $validType = false;
                    $experience = $this->params['data']['experience_id'];
                    $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $experienceValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($experienceValidate['data']['list'] as $valid){
                        if ($valid['id'] == $experience){
                            $validType = ($valid['incidencia_porcentaje'] > $reserva['data']['list']['experiencia']['incidencia_porcentaje']) ? true : false;
                        }
                    }
                    if($this->params['data']['experience_id'] != "") {
                        if ($validType && ($reserva['data']['list']['experiencie']['id'] != $this->params['data']['experience_id'])) {
                            $reservation_persistence->experience_id = $this->params['data']['experience_id'] != "" ? $this->params['data']['experience_id'] : null;
                        } else {
                            $response = 'Experiencia Invalida';
                            return $response;
                        }
                    }
                    $response = $reservation_persistence->save();
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
                    if ($validMaxOfPeople >= ($this->params['data']['adults']+$this->params['data']['kids']) && (($reserva['data']['list']['adultos'] != $this->params['data']['adults']) || ($reserva['data']['list']['ninos'] != $this->params['data']['kids']))) {
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->adults = $this->params['data']['adults'] != "" ? $this->params['data']['adults'] : null;
                    $reservation_persistence->kids = $this->params['data']['kids'] != "" ? $this->params['data']['kids'] : null;
                    }else{
                        $response = 'maximo de huespedes excedido';
                        return $response;
                    }

                    $tipologia = $this->params['data']['tipologia_id'];
                    $handler = new AvailabilityRoomHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $roomValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($roomValidate['data']['list'] as $valid){
                        if ($valid['id'] == $tipologia){
                            $validType = ($valid['incidencia_porcentaje'] > $reserva['data']['list']['tipologia']['incidencia_porcentaje']) ? true : false;
                        }
                    }
                    if($this->params['data']['tipologia_id'] != "") {
                        if ($validType && ($reserva['data']['list']['tipologia']['id'] != $this->params['data']['tipologia_id'])) {
                            $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                            $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'] != "" ? $this->params['data']['tipologia_id'] : null;
                        } else {
                            $response = 'Tipologia Invalida';
                            return $response;
                        }
                    }
                    $plan = $this->params['data']['plan_id'];
                    $actualPrice = $reserva['data']['list']['tarifa']['extra_id'] != 0 ? $reserva['data']['list']['tarifa']['extra']['base_imponible'] : 0;
                    $handler = new AvailabilityPlanHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $planValidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($planValidate['data']['list'] as $valid){
                        if ($valid['id'] == $plan && $valid['extra']['base_imponible'] > $actualPrice){
                            $validType = true;
                        }
                    }
                    if($this->params['data']['plan_id'] != "") {
                        if ($validType && ($reserva['data']['list']['tarifa']['id'] != $this->params['data']['plan_id'])) {
                            $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                            $reservation_persistence->plan_id = $this->params['data']['plan_id'] != "" ? $this->params['data']['plan_id'] : null;
                        } else {
                            $response = 'Plan Invalido';
                            return $response;
                        }
                    }
                    $experience = $this->params['data']['experience_id'];
                    $handler = new AvailabilityExperienceHandler(['reserva_id' => $this->params['data']['reserva_id']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        $experiencelidate = $handler->getData();
                    }else{
                        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
                    }
                    foreach ($experiencelidate['data']['list'] as $valid){
                        if ($valid['id'] == $experience){
                            $validType = ($valid['incidencia_porcentaje'] > $reserva['data']['list']['experiencia']['incidencia_porcentaje']) ? true : false;
                        }
                    }
                    if($this->params['data']['experience_id'] != "") {
                        if ($validType && ($reserva['data']['list']['experiencie']['id'] != $this->params['data']['experience_id'])) {
                            $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                            $reservation_persistence->experience_id = $this->params['data']['experience_id'] != "" ? $this->params['data']['experience_id'] : null;
                        } else {
                            $response = 'Experiencia Invalida';
                            return $response;
                        }
                    }
                    $response = $reservation_persistence->save();
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