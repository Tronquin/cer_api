<?php
namespace App\Handler\PaymentGateway;

use App\Handler\BaseHandler;
use App\Service\PaymentGatewayService;

class ReservationProcessPaymentHandler extends BaseHandler{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $paymentGateway = PaymentGatewayService::getPaymentGateway($this->params['data']['payment_type']);
        $paymentGateway->setCurrency('EUR');
        $payments = $paymentGateway->processPayment($this->params['data']);

        return $payments;
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