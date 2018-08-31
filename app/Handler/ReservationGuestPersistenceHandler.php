<?php
namespace App\Handler;

use App\ReservationGuestPersistence;
use App\Service\ERPService;

class ReservationGuestPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
            $guest_persistence = ReservationGuestPersistence::where('reserva_id', '=', $this->params['data']['reserva_id'])->first();

            if (count($guest_persistence) > 0) {
                $guest_persistence->delete();

                foreach ($this->params['data']['huesped'] as $guest) {
                    $guest_persistence = new ReservationGuestPersistence();
                    $guest_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $guest_persistence->guest_id = $guest['id'];
                    $guest_persistence->type_id = $guest['tipo'];
                    $guest_persistence->nombre = $guest['nombre'];
                    $guest_persistence->apellido = $guest['apellido'];
                    $guest_persistence->nacionalidad = $guest['nacionalidad'];
                    $guest_persistence->sexo = $guest['sexo'];
                    $guest_persistence->fecha_nacimiento= $guest['fecha_nacimiento'];
                    $guest_persistence->identificacion = $guest['identificacion'];
                    $guest_persistence->pais = $guest['pais'];
                    $guest_persistence->email = $guest['email'];
                    $guest_persistence->telefono = $guest['telefono'];
                    $guest_persistence->img = $guest['img'];

                    $response = $guest_persistence->save();
                }
                return $response;
            } else {

                foreach ($this->params['data']['huespedes'] as $guest) {
                    $guest_persistence = new ReservationGuestPersistence();
                    $guest_persistence->reserva_id = $this->params['data']['reserva_id'];
                    $guest_persistence->guest_id = $guest['id'];
                    $guest_persistence->type_id = $guest['tipo'];
                    $guest_persistence->nombre = $guest['nombre'];
                    $guest_persistence->apellido = $guest['apellido'];
                    $guest_persistence->nacionalidad = $guest['nacionalidad'];
                    $guest_persistence->sexo = $guest['sexo'];
                    $guest_persistence->fecha_nacimiento = $guest['fecha_nacimiento'];
                    $guest_persistence->identificacion = $guest['identificacion'];
                    $guest_persistence->pais = $guest['pais'];
                    $guest_persistence->email = $guest['email'];
                    $guest_persistence->telefono = $guest['telefono'];
                    $guest_persistence->img = $guest['img'];

                    $response = $guest_persistence->save();
                }
                return $response;
            }
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
            'huesped' =>'required',
        ];
    }

}