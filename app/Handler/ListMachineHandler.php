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

        $machines= Machine::with(['components', 'location', 'oAuth2Client'])->orderBy('description', 'asc')->get();

        foreach ($machines as $machine) {

            $temp = [
                'id' => $machine->public_id,
                'description' => $machine->description,
                'ubication' => $machine->location->ubicacion_id,
                'phone' => $machine->phone,
                'device_url' => $machine->device_url,
                'time_repose' => $machine->time_repose,
                'created_at' => $machine->created_at,
                'token' => $machine->oAuth2Client->token
            ];

            $temp['components'] = [];
            foreach ($machine->components as $key => $component) {
                $temp['components'][$key]['name'] = $component->name;
                $temp['components'][$key]['active'] = $component->pivot->active;
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