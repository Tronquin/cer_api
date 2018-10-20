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
            $guest_persistence = ReservationGuestPersistence::where('reserva_id', '=', $this->params['data']['reserva_id'])->delete();

            foreach ($this->params['data']['huesped'] as $huesped) {

                $guest_persistence = new ReservationGuestPersistence();

                $guest_persistence->reserva_id = $this->params['data']['reserva_id'];
                $guest_persistence->guest_id = $huesped['id'];
                $guest_persistence->reservation_type_id = $huesped['isAdult'] ? 1 : 2;
                $guest_persistence->nombre = $huesped['nombre'];
                $guest_persistence->apellido1 = $huesped['apellido1'];
                $guest_persistence->apellido2 = $huesped['apellido2'];
                $guest_persistence->nacionalidad = $huesped['nacionalidad'];
                $guest_persistence->sexo = $huesped['sexo'];
                $guest_persistence->fecha_nacimiento = $huesped['fecha_nacimiento'];
                $guest_persistence->identificacion = $huesped['numero'];
                $guest_persistence->tipo_documento = $huesped['tipo_documento'];
                $guest_persistence->pais = $huesped['pais'];
                $guest_persistence->email = isset($huesped['email']) ? $huesped['email'] : null;
                $guest_persistence->telefono = isset($huesped['phone']) ? $huesped['phone'] : null;
                $guest_persistence->img = $huesped['url'];
                $guest_persistence->status_id = 1;
                
                $response = $guest_persistence->save();

                if($response != true)break;

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
            'reserva_id' =>'required|numeric',
            'huesped' =>'required',
        ];
    }

}