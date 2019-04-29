<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class UpdateUserPasswordHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $payload = JWTAuth::getPayload($this->params['token'])->toArray();
        $delta = 86400; //24 horas en milisegundos
        $response = [
            'res' => 0,
            'msg' => 'Token Expirado',
            'data' => [],
        ];

        if ($payload['timestamp'] > $delta) {
            return $response;
        }

        $usuario = User::find($payload['id']);

        if (!$usuario) {
            $response = [
                'res' => 0,
                'msg' => 'Usuario no Encontrado',
                'data' => [],
            ];
            return $response;
        }

        $usuario->password = Hash::make($payload['newPassword']);
        $usuario->save();
        $response = [
                'res' => 1,
                'msg' => 'Clave de Usuario actualizada',
                'data' => [$usuario, $payload['newPassword']]
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
