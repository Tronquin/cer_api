<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;

class FindLocationsHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $locations = Location::all();

        return $locations;
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