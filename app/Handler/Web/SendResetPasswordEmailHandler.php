<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use \Firebase\JWT\JWT;

class SendResetPasswordEmailHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $user = User::find($this->params['user_id']);
        $response = [
            'res' => 0,
            'msg' => 'Usuario no encontrado',
            'data' => [],
        ];

        if (!$user) {
            return $response;
        }

        $secret = "c4StR0W3b2019";
        $timestamp = $_SERVER['REQUEST_TIME'];
        $payload = ['id' => $user->id, 'timestamp' => $timestamp];
        $token = JWT::encode($payload, $secret);
        $iso = $this->params['iso'];
        $host = config('app.web_url');
        $url = $host . '/' . $iso . '/' . $token . '/reset';


        Mail::to($user->email)->send(new ResetPassword($url));


        $response = [
            'res' => 1,
            'msg' => 'Correo Enviado!',
            'data' => ['token' => $token, 'url' => $url, 'payload' => $payload],
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
        return [];
    }
}
