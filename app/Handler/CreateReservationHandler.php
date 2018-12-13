<?php
namespace App\Handler;

use App\Service\ERPService;

/**
 * Registra una reservacion en el ERP
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class CreateReservationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        return ERPService::createReservation($this->params);
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'ubicacion_id' => 'required|numeric',
            'fecha_entrada' => 'required|date_format:Y-m-d',
            'fecha_salida' => 'required|date_format:Y-m-d',
            'tipologia_id' => 'required|numeric',
            'apartamento_id' => 'required|numeric',
            'cliente_email' => 'required|email',
            'cliente_nombre' => 'required',
            'cliente_apellido' => 'required',
            //'cliente_cif' => 'required',
            'cliente_telefono' => 'required',
            //'cliente_pais' => 'required|regex:/^[A-Z]{2}$/',
            //'cliente_calle' => 'required',
            //'cliente_numero' => 'required',
            //'cliente_piso' => 'required',
            //'cliente_cpostal' => 'required',
            //'cliente_ciudad' => 'required',
            'experiencia_id' => 'required|numeric',
            'regimen_id' => 'required|numeric',
            'politica_id' => 'required|numeric',
            'promocion_id' => 'required|numeric',
            'adultos' => 'required|numeric',
            'ninos' => 'required|numeric'
        ];
    }

}