<?php
namespace App\Handler;

use App\Machine;

class ListMachineHandler extends BaseHandler {

    /**
     * Handler que devuelve un listado de Maquinas
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];

        $machines= Machine::with('components')->with('machineUbication')->orderBy('description', 'asc')->get();

        foreach ($machines as $machine) {

            $temp = [
                'id' => $machine->public_id,
                'description' => $machine->description,
                'ubication' => $machine->machineUbication->name,
                'created_at' => $machine->created_at
            ];

            $temp['components'] = [];
            foreach ($machine->components as $key => $component) {
                if ($component->pivot->active) {
                    $temp['components'][$key] = $component->name;
                }
            }

            $response['data'][] = $temp;
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
        return [];
    }

}