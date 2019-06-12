<?php
namespace App\Handler;

use App\Country;

/**
 * Obtiene listado de paises
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class GetCountryHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $countries = Country::orderBy('name')->get();

        return [
            'res' => count($countries),
            'msg' => 'Listado de paises',
            'data' => $countries
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [];
    }

}