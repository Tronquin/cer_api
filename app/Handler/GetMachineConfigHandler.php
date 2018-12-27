<?php

namespace App\Handler;


use App\Machine;

class GetMachineConfigHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $machine = Machine::query()
            ->where('public_id', $this->params['publicId'])
            ->with(['location', 'components'])
            ->firstOrFail();

        $response = [
            'public_id' => $machine->public_id,
            'ubication' => $machine->location->ubicacion_id,
            'phone' => $machine->phone,
            'device_url' => $machine->device_url,
            'time_repose' => $machine->time_repose,
            'components' => []
        ];

        foreach ($machine->components as $component) {
            $response['components'][] = [
                'name' => $component->name,
                'active' => (bool) $component->pivot->active
            ];
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
            'publicId' => 'required'
        ];
    }
}