<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class sendResetPasswordEmailHandler extends BaseHandler
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

        $token = $this->params['token'];
        $host = request()->getSchemeAndHttpHost();
        $url = $host . "/" . $this->params['user_id'] . "/" . $token;

        Mail::to($this->params['email'])->send($url);

        $response = [
            'res' => 1,
            'msg' => 'Correo Enviado!',
            'data' => [],
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
            'id' => 'required',
            'email' => 'required'
        ];
    }
}
