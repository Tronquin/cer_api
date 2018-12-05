<?php
namespace App\Handler;

use App\Machine;

class ListMachineHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $machines= Machine::orderBy('description')->get();

        return $machines;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [ ];
    }

}