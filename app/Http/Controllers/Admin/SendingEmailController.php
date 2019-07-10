<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\EmailService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\Web\SendConfirmationReserveHandler;
use App\Handler\Web\Send48hrsEmailReservationHandler;
use App\Handler\Web\SendCancelacionReservationEmailHandler;
use App\Handler\Web\SendNewExtraLandingErpHandler;

class SendingEmailController extends Controller
{
   
    /**
    * Envio de email de confirmacion de Reserva
    * @param Request $request 
    * @return mixed
    */
    public function sendConfirmationReserve(Request $request){

        $data = $request->all();
        \App::setLocale($data['iso']);
        $handler = new SendConfirmationReserveHandler($data);
        $handler->processHandler();
        $data = $handler->getData();
        
        if ($handler->isSuccess()) {
            \App::setLocale('es');
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
    * Envio de email de cancelacion de Reserva
    * @param Request $request 
    * @return mixed
    */
    public function sendCancelacionReserve(Request $request){

        $data = $request->all();
        \App::setLocale($data['iso']);
        $handler = new SendCancelacionReservationEmailHandler($data);
        $handler->processHandler();
        $data = $handler->getData();
        
        if ($handler->isSuccess()) {
            \App::setLocale('es');
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
    * Envio de email de nuevoExtraLanding ERP
    * @param Request $request 
    * @return mixed
    */
    public function sendNewExtraLanding(Request $request){

        $data = $request->all();
        \App::setLocale($data['iso']);
        $handler = new SendNewExtraLandingErpHandler($data);
        $handler->processHandler();
        $data = $handler->getData();
        
        if ($handler->isSuccess()) {
            \App::setLocale('es');
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    
}