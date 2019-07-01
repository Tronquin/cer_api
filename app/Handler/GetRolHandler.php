<?php
namespace App\Handler;

use App\Rol;

/**
 * Obtiene listado de roles
 *
 * 
 */
class GetRolHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $roles = Rol::all();

        return [
            'res' => count($roles),
            'msg' => 'Listado de roles',
            'data' => $roles
        ];
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