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

        if (!$usuario) return $response;

        $usuario->name = $this->params['name'];
        $usuario->last_name = $this->params['last_name'];
        $usuario->email = $this->params['email'];
        $usuario->gender = isset($this->params['gender']) ? $this->params['gender'] : null;
        $usuario->pais = isset($this->params['pais']) ? $this->params['pais'] : null;
        $usuario->phone = isset($this->params['phone']) ? $this->params['phone'] : null;
        $usuario->ciudad = isset($this->params['ciudad']) ? $this->params['ciudad'] : null;
        $usuario->direccion = isset($this->params['direccion']) ? $this->params['direccion'] : null;
        $usuario->postal_code = isset($this->params['postal_code']) ? $this->params['postal_code'] : null;
        $usuario->birthday = isset($this->params['birthday']) ? $this->params['birthday'] : null;

        $usuario->save();
        unset($usuario['password']);
        $response = [
            'res' => 1,
            'msg' => 'Usuario actualizado',
            'data' => $usuario,
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
            'user_id' => 'required|numeric',
            'name' => 'required',
            //'last_name' => 'required',
            'email' => 'required',
            /*'gender' => 'required',
            'pais' => 'required|numeric',
            'ciudad' => 'required|numeric',
            'postal_code' => 'required',
            'phone' => 'required',
            'direccion' => 'required',
            'birthday' => 'required',*/
        ];
    }
}
