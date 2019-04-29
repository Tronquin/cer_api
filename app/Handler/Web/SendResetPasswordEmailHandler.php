<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

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

        $timestamp = $_SERVER['REQUEST_TIME'];
        $iso = $this->params['iso'];
        $factory = JWTFactory::customClaims([
            'id' => $user->id,
            'timestamp' => $timestamp,
        ]);
        $payload = $factory->make();
        $token = JWTAuth::encode($payload);
        $secret = env('JWT_SECRET', 0);
        $host = config('app.web_url');
        $url = $host . "/" . $iso . "/" . $token . '/reset';

   
        Mail::to($user->email)->send(new ResetPassword($url));

        
        $response = [
            'res' => 1,
            'msg' => 'Correo Enviado!',
            'data' => ['token' => $token, 'key' => $secret , 'url' => $url],
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
