<?php
namespace App\Service;
use App\Service\PaymentTypes\StripePaymentService;

class PaymentGatewayService
{
    /**
     * Obtiene los datos del pago segun type
     */
    const Stripe = 1;
    const paypal = 2;

    public static function getPaymentGateway($type){

        if ($type == self::Stripe) {
            //Pago por TDC en moneda extranjera
            $config = config('payments.Payment_Gateway');
            $paymenGateway = new StripePaymentService($config['Stripe']);
        } elseif ($type == self::Paypal) {
            //Pago por Paypal
            $paymenGateway = new BanckTransferPaymentGateway();
        }
        return $paymenGateway;
    }
} 