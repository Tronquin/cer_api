<?php
namespace App\Handler;

use App\Component;
use App\Location;
use App\Machine;

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

        $machineUbication = Location::where('nombre','=',$this->params['data']['ubication'])->first();
        $machine->description = $this->params['data']['description'];
        $machine->time_repose = $this->params['data']['time_repose'];
        $machine->device_url = $this->params['data']['device_url'];
        $machine->phone = $this->params['data']['phone'];
        $machine->location_id = $machineUbication->id;
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
            'device_url' => 'required',
            'phone' => 'required'
        ];
    }

}