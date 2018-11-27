<?php
namespace App\Handler;

use App\Service\ERPService;

class DeactivateKeyHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        
        $response = ERPService::deactivateKey(['reserva_id' => $this->params['reserva_id']]);

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
            'reserva_id' => 'required|numeric',
        ];
    }

}