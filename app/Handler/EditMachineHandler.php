<?php
namespace App\Handler;


use App\Machine;

class EditMachineHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $machine = Machine::where('public_id','=',$this->params['id'])->firstOrFail();

        $response = [];
        $response['data'] = [];
        $response['success'] = false;
        $response['mesagge'] = '';


        if (! is_null($machine)) {

            $temp = [
                'id' => $machine->public_id,
                'description' => $machine->description,
                'ubication' => $machine->machineUbication->name
            ];

            $temp['components'] = [];
            foreach ($machine->components as $key => $component) {
                if ($component->pivot->active) {
                    $temp['components'][$key] = $component->name;
                }
            }

            $response['data'] = $temp;
            $response['success'] = true;
            $response['mesagge'] = 'success';
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
            'id' =>'required',
        ];
    }

}