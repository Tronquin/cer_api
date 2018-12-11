<?php
namespace App\Handler;

use App\Component;
use App\Machine;
use App\MachineUbication;

class SaveMachineHandler extends BaseHandler {

    /**
     * Handler que crea una nueva maquina
     *
     */
    protected function handle()
    {
        $now = new \DateTime();
        $machine = new Machine();
        $response = [];

        $machineUbication = MachineUbication::where('name','=',$this->params['data']['ubication'])->first();
        $machine->description = $this->params['data']['description'];
        $machine->machine_ubication_id = $machineUbication->id;
        $machine->public_id = uniqid('MAC-');

        $machine->save();

        $components = Component::orderBy('name')->get(); 
        foreach($components as $key => $component) {
            $machine->components()->attach($component->id,['active' => true,
                'created_at' => $now->format('Y-m-d H:i:s'), 'updated_at' => $now->format('Y-m-d H:i:s')]);
        }

        $response['data'] = ['machine' => $machine->public_id];

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
            'ubication' => 'required',
            'description' => 'required',
            'components' => 'required'
        ];
    }

}