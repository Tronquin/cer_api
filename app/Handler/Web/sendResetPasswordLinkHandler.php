<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;

class sendResetPasswordLinkHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
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
