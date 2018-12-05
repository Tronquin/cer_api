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
            'ubication_id' => 'required|numeric',
            'checkin' => 'required|date_format:Y-m-d',
            'checkout' => 'required|date_format:Y-m-d',
            'typology_id' => 'required|numeric',
            'apartment_id' => 'required|numeric',
            'email' => 'required|email',
            'name' => 'required',
            'lastName' => 'required',
            'rif' => 'required',
            'phone' => 'required',
            'country' => 'required|regex:/^[A-Z]{2}$/',
            'street' => 'required',
            'clientId' => 'required',
            'floor' => 'required',
            'zipCode' => 'required',
            'city' => 'required',
            'experience_id' => 'required|numeric',
            'regime_id' => 'required|numeric',
            'policy_id' => 'required|numeric',
            'promotion_id' => 'required|numeric',
            'adults' => 'required|numeric',
            'kids' => 'required|numeric'
        ];
    }

}