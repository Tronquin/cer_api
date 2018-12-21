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
        $name = str_replace(' ', '_', $this->params['data']['holder']);
        $date = $this->params['data']['date'];
        $cvc = $this->params['data']['cvc'];

        $ccString = "{$cc}/{$date}/{$cvc}";
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('$4a$'), $ccString, MCRYPT_MODE_CBC, md5(md5('$4a$'))));

        $response = ERPService::processPayment([
            'pago_id' => $this->params['data']['paymentId'],
            'nombre' => $this->params['data']['holder'],
            'nombre_apellido' => $this->params['data']['holder'],
            'enc' => $ccString
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
            'paymentId' => 'required|numeric',
            'creditCard' => 'required',
            'holder' => 'required',
            'date' => 'required|regex:/^[0-9]{2}-[0-9]{4}$/',
            'cvc' => 'required'
        ];
    }

}