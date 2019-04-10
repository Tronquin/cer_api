<?php

namespace App\Handler;

use App\Machine;
use App\MachineLog;
use Carbon\Carbon;

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
        $now = Carbon::now();

        foreach ($machines as $machine) {

            $tempResponse = $machine->toArray();
            $tempResponse['logs'] = MachineLog::query()
                ->where('machine_id', $machine->id)
                ->orderBy('created_at', 'DESC')
                ->limit($this->params['limit'])
                ->get()
                ->toArray()
            ;

            $tempResponse['logs'] = array_map(function ($log) use ($now) {

                $dateLog = Carbon::parse($log['created_at']);
                $log['time'] = $dateLog->diffForHumans($now);

                return $log;

            }, $tempResponse['logs']);

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