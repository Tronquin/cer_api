<?php
namespace App\Handler\PaymentGateway;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use Request;

class ReservationProcessPaymentHandler extends BaseHandler{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $cc = $this->params['data']['creditCard'];
        $name = str_replace(' ', '_', $this->params['data']['holderName']);
        $date = $this->params['data']['date'];
        $cvv = $this->params['data']['cvv'];

        $ccString = "{$cc}/{$name}/{$date}/{$cvv}";
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('$4a$'), $ccString, MCRYPT_MODE_CBC, md5(md5('$4a$'))));

        $response = ERPService::processPayment([
            'pago_id' => $this->params['data']['payment_id'],
            'nombre' => $this->params['data']['holderName'],
            'enc' => $encrypted
        ]);

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
            'payment_id' => 'required|numeric',
            'creditCard' => 'required',
            'holderName' => 'required',
            'holderId' => 'required',
            'date' => 'required|regex:/^[0-9]{2}-[0-9]{4}$/',
            'cvv' => 'required'
        ];
    }

}