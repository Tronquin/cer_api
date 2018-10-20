<?php
namespace App\Handler;


use App\Service\ERPService;

class CheckoutHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::setCheckout(['reserva_id' => $this->params['data']['reserva_id']]);

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
            'reserva_id' =>'required',
        ];
    }

}