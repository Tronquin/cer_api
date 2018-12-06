<?php
namespace App\Handler;

use App\MachineUbication;
use App\Component;

class CreateMachineHandler extends BaseHandler {

    /**
     * Handler que envía los datos necesarios para crear una maquina
     * Proceso de este handler
     */
    protected function handle()
    {
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

        $response['data'] =  [
            'ubications' => $ubicationsArray,
            'components' => $componentsArray
        ];

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
        ];
    }

}