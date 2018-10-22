<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\PaymentGateway\ReservationProcessPaymentHandler;

class PaymentGatewayController extends Controller{

    /**
     * Processa los pagos realizados por un paymentGateway
     * @param Request $request
     * @return jsonResponse
     */
    public function processReservationPayment(Request $request){

        $request = $request->all();
        $handler = new ReservationProcessPaymentHandler($request);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}