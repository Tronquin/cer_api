<?php
namespace App\Handler;

use App\MachineUbication;
use App\Component;
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

            $ubications = MachineUbication::orderBy('name')->get();

            $ubicationsArray = [];
            foreach($ubications as $key => $ubication) {
                //$ubicationsArray[$key]['code'] = $ubication->id;
                $ubicationsArray[$key]['name'] = $ubication->name;
            }

            $components = Component::orderBy('name')->get();
            $componentsArray = [];
            foreach($components as $key => $component) {
                //$componentsArray[$key]['code'] = $component->id;
                $componentsArray[$key]['name'] = $component->name;
            }        

            /** Machine **/
            $temp['machine'] = [
                'id' => $machine->public_id,
                'description' => $machine->description,
                'ubication' => $machine->machineUbication->name
            ];

            $temp['machine']['components'] = [];
            foreach ($machine->components as $key => $component) {
                if ($component->pivot->active) {
                    $temp['machine']['components'][$key] = $component->name;
                }
            }


            $temp['list_ubications'] =  $ubicationsArray;
            $temp['list_components'] = $componentsArray;            

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