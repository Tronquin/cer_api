<?php
namespace App\Handler;

use App\Service\EmailService;
use App\User;
use App\Handler\BaseHandler;
use \Firebase\JWT\JWT;
use CTrans;

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
        $timestamp = (new \DateTime())->getTimestamp();
        $payload = ['id' => $user->id, 'timestamp' => $timestamp];
        $token = JWT::encode($payload, $secret);
        $host = config('app.admin_url');
        $url = $host . '/forgot/reset/' . $token;
        $iso = 'es';
        
        EmailService::send('email.resetPassword', CTrans::trans('email.subject.resetPassword', $iso), [$user->email], ['url' => $url, 'iso' => $iso]);

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
