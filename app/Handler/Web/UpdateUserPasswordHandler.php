<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordHandler extends BaseHandler
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

        $usuario->password = Hash::make($this->params['new_password']);
        $usuario->save();
        $response = [
            'res' => 1,
            'msg' => 'Clave de Usuario actualizada',
            'data' => [$usuario, $this->params['new_password']]
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
