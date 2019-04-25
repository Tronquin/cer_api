<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;

class UpdateUserHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $usuario = User::find($this->params['user_id']);

        $response = [
            'res' => 0,
            'msg' => 'Usuario no encontrado',
            'data' => [],
        ];

        if (!$usuario) {
            return $response;
        }

        if ($this->params['old_password'] = $this->params['new_password']) {
            $response = [
                'res' => 0,
                'msg' => 'Antigue Contraseña igual a Nueva Contraseña',
                'data' => [],
            ];
        } elseif ($this->params['new_password'] != $this->params['new_password_confirm']) {
            $response = [
                'res' => 0,
                'msg' => 'La nueva contraseña no coincide con la confirmacion',
                'data' => [],
            ];
        } else {
            $usuario->password = Hash::make($this->params['new_password']);
            $usuario->save();
            $response = [
                'res' => 1,
                'msg' => 'Clave de Usuario actualizada',
                'data' => $usuario,
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
            'user_id' => 'required|numeric'
        ];
    }
}
