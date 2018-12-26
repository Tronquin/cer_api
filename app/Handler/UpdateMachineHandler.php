<?php
namespace App\Handler;

use App\Component;
use App\Machine;

class UpdateMachineHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {        

        $machine = Machine::where('public_id','=',$this->params['data']['id'])->firstOrFail();
        $now = new \DateTime();
        $response = [];
        $response['data'] = [];
        $response['success'] = false;
        $response['mesagge'] = '';


        if (! is_null($machine)) {

            //$machineUbication = MachineUbication::where('name','=',$this->params['data']['ubication'])->first();
            $machine->description = $this->params['data']['description'];
            //$machine->api_url = $this->params['data']['api_url'];
            $machine->device_url = $this->params['data']['device_url'];
            $machine->phone = $this->params['data']['phone'];
            $machine->machine_ubication_id = (int)$this->params['data']['ubication'];

            $machine->save();

            /** no se modifican los componentes **/
            /*
            $componentArray = [];
            if (isset($this->params['data']['components'])) {
                foreach ($this->params['data']['components'] as $key => $component) {
                    $machineComponent = Component::where('name', '=' , $component['name'])->first();
                    $componentArray[$machineComponent->id]['active'] = true;
                }
                $machine->components()->sync($componentArray);                
            }
            */            

            $response['data'] = ['machine' => $machine->public_id];
            $response['success'] = true;
            $response['mesagge'] = 'machine updated';
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
            'id' => 'required',
            'description' => 'required',
            'ubication' => 'required',
            'phone' => 'required',
            //'api_url' =>'required',
            'device_url' => 'required'
        ];
    }

}