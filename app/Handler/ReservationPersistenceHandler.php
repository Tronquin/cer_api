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

            if($this->params['data']['type'] == 'pax'){

                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $reservation_persistence->adults = $this->params['data']['adults'];
                    $reservation_persistence->kids = $this->params['data']['kids'];
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->adults = $this->params['data']['adults'];
                    $reservation_persistence->kids = $this->params['data']['kids'];
                    $response = $reservation_persistence->save();
                }
            }elseif ($this->params['data']['type'] == 'room'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'];
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->tipologia_id = $this->params['data']['tipologia_id'];
                    $response = $reservation_persistence->save();
                }
            }elseif ($this->params['data']['type'] == 'plan'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $reservation_persistence->plan_id = $this->params['data']['plan_id'];
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->plan_id = $this->params['data']['plan_id'];
                    $response = $reservation_persistence->save();
                }
            }elseif ($this->params['data']['type'] == 'experience'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $reservation_persistence->experience_id = $this->params['data']['experience_id'];
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->experience_id = $this->params['data']['experience_id'];
                    $response = $reservation_persistence->save();
                }
            }elseif ($this->params['data']['type'] == 'service'){
                $reservation_persistence = ReservationPersistence::where('reserva_id','=',$this->params['data']['reserva_id'])->first();

                if (count($reservation_persistence) >= 1){
                    $services = unserialize($reservation_persistence->services);
                    dump($this->params['data']);
                    $newServices = [
                        'id' => $this->params['data']['services'][0]['id'],
                        'cantidad' => $this->params['data']['services'][0]['cantidad'],
                    ];
                    dump($services);
                    array_push($newServices, $services);
                    $reservation_persistence->services = $services;
                    dump($services);
                    $response = $reservation_persistence->save();
                }else{
                    $reservation_persistence = new ReservationPersistence();
                    $reservation_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $reservation_persistence->services = serialize($this->params['data']['services']);
                    $response = $reservation_persistence->save();
                    dump(serialize($this->params['data']['services']));
                }
            }else{

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