<?php
namespace App\Handler;


use App\ReservationPersistence;
use App\Service\ERPService;

class ReservationGuestPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {

        $reservation_persistence = ReservationGuestPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();
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