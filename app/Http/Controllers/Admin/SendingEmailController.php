<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\Web\SendConfirmationReserveHandler;

class SendingEmailController extends Controller
{
   
    /**
    * Envio de email de confirmacion de Reserva
    * @param Request $request 
    * @return mixed
    */
    public function sendConfirmationReserve(Request $request){

        $data = $request->all();
        $handler = new SendConfirmationReserveHandler($data);
        $handler->processHandler();
        $data = $handler->getData();
        if ($handler->isSuccess()) {
            return view('email.confirmacionReserva', ['data' => $data['data']]);
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}