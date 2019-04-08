<?php

namespace App\Handler;
use App\Machine;
use App\MachineLog;

/**
 * Obtiene los logs de las maquinas
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class FindMachineLogHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $machines = Machine::query()->with(['location'])->get();

        foreach ($machines as $machine) {

            $tempResponse = $machine->toArray();
            $tempResponse['logs'] = MachineLog::query()
                ->where('machine_id', $machine->id)
                ->orderBy('created_at', 'DESC')
                ->limit($this->params['limit'])
                ->get()
                ->toArray()
            ;

            $response[] = $tempResponse;
        }

        return [
            'res' => count($response),
            'data' => $response
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
           'limit' => 'numeric'
        ];
    }

}