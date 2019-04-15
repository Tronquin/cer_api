<?php
namespace App\Handler;

use App\Machine;
use App\ExtraOustanding;

class DeleteMachineHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        if (ExtraOustanding::where('id', '=', $this->params['id'])->delete()) {
            Storage::delete($this->params['document']);
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
