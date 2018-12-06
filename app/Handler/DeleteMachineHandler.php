<?php
namespace App\Handler;


use App\Machine;

class DeleteMachineHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        if (Machine::where('public_id', '=', $this->params['id'])->delete())
        {
            return ['data' => ['deleted' => true]];
        }

        return ['data' => ['deleted' => false]];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'id' =>'required',
        ];
    }

}