<?php
namespace App\Handler;

use App\Service\EmailService;
use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\BaseMail;
use \Firebase\JWT\JWT;

class SendResetPasswordEmailAdminHandler extends BaseHandler
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

        $secret = env('SECRET');
        $timestamp = $_SERVER['REQUEST_TIME'];
        $payload = ['id' => $user->id, 'timestamp' => $timestamp];
        $token = JWT::encode($payload, $secret);
        $host = config('app.admin_url');
        $url = $host . '/reset/' . $token;

        EmailService::send('email.resetPassword', 'Reset Password', [$user->email], ['url' => $url]);

        $response = [
            'res' => 1,
            'msg' => 'Correo Enviado!',
            'data' => ['token' => $token],
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
