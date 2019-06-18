<?php
namespace App\Handler\Web;

use App\Service\EmailService;
use App\User;
use App\Handler\BaseHandler;
use \Firebase\JWT\JWT;
use CTrans;

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
        $iso = $this->params['iso'];

        $response = [
            'res' => 0,
            'msg' => CTrans::trans('email.msg.userNotFound', $iso),
            'data' => [],
        ];

        if (!$user) {
            return $response;
        }

        $secret = env('SECRET');
        $timestamp = $_SERVER['REQUEST_TIME'];
        $payload = ['id' => $user->id, 'timestamp' => $timestamp];
        $token = JWT::encode($payload, $secret);
        $host = config('app.web_url');
        $url = $host . '/' . $iso . '/' . $token . '/reset';

        EmailService::send('email.resetPassword', CTrans::trans('email.subject.resetPassword', $iso), [$user->email], ['url' => $url, 'iso' => $iso]);

        $response = [
            'res' => 1,
            'msg' => CTrans::trans('email.send', $iso),
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
