<?php
namespace App\Handler;


use App\Service\ERPService;

class ReservationEditMailHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::editMail($this->params['data']);

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
            'cliente_id' =>'required|numeric',
            'email' =>'required'
        ];
    }

}