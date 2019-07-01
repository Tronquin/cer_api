<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Hash;
use CTrans;

class UpdatePasswordHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $usuario = User::find($this->params['user_id']);
        $lang = $this->params['lang'];

        $response = [
            'res' => 0,
            'msg' => CTrans::trans('email.msg.userNotFound', $lang),
            'data' => [],
        ];

        if (!$usuario) {
            return $response;
        }

        $passProblem = false;

        if(Hash::check($this->params['new_password'], $usuario->password)){
            $passProblem = true;

            $response = [
                'res' => 1,
                'msg' => CTrans::trans('api.resetPassword.passError', $lang),
                'data' => [],
                'passwordStatus' => $passProblem
            ];
        }else{
            $usuario->password = Hash::make($this->params['new_password']);
            $usuario->save();

            $response = [
                'res' => 1,
                'msg' => CTrans::trans('api.resetPassword.changed', $lang),
                'data' => [$usuario, $this->params['new_password']],
                'passwordStatus' => $passProblem
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
        ];
    }
}
