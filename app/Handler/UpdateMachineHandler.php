<?php
namespace App\Handler;


use App\Component;
use App\Machine;
use App\MachineUbication;

class UpdateMachineHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        //$data = $this->params['data'];

        $machine = Machine::where('public_id','=',$this->params['id'])->firstOrFail();
        $now = new \DateTime();

        if (! is_null($machine)) {

            $machineUbication = MachineUbication::where('name','=',$this->params['data']['ubication'])->first();
            $machine->description = $this->params['data']['description'];
            $machine->machine_ubication_id = $machineUbication->id;

            $machine->save();

            $componentArray = [];
            foreach ($this->params['data']['components'] as $key => $component) {
                $machineComponent = Component::where('name', '=' , $component['name'])->first();
                $componentArray['id'] = $machineComponent->id;
                $componentArray['active'] = true;
            }

            $machine->components()->sync($componentArray);

            $response['data'] = ['machine' => $machine->public_id];

        }
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