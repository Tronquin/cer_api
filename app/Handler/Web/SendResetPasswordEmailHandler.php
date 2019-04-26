<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

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

        $userId = $user->id;
        $token = $this->params['token'];
        $host = config('app.web_url');
        $url = $host . "/es/" . $this->params['user_id'] . '/' . $token . '/reset';

   
        Mail::to($user->email)->send(new ResetPassword($url));

        
        $response = [
            'res' => 1,
            'msg' => 'Correo Enviado!',
            'data' => [$userId, $token, $url],
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
