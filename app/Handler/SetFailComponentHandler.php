<?php
namespace App\Handler;
use App\Component;
use App\Machine;
use App\MachineComponentError;

/**
 * Indica la falla de un dispositivo de la maquina
 *
 *
 */
class SetFailComponentHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $machine = Machine::where('public_id', $this->params['data']['machine'])->with(['components'])->firstOrFail();
        $component = Component::where('code', $this->params['data']['device'])->firstOrFail();

        $machineComponentError = new MachineComponentError();
        $machineComponentError->machine_id = $machine->id;
        $machineComponentError->component_id = $component->id;
        $machineComponentError->fail = $this->params['data']['fail'];
        $machineComponentError->save();

        $errors = MachineComponentError::where('machine_id', $machine->id)
            ->where('component_id', $component->id)
            ->count()
        ;

        if ($errors > 5) {

            foreach ($machine->components as $comp) {

                if ($component->id === $comp->id) {
                    $comp->pivot->active = false;
                    $comp->pivot->save();
                    break;
                }
            }
        }

        $response['data'] = ['machine' => $machine->public_id];
        $response['res'] = 1;
        $response['msg'] = 'Error registrado';

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
            'device' => 'required',
            'machine' => 'required',
            'fail' => 'required'
        ];
    }

}