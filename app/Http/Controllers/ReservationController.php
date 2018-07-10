<?php

namespace App\Http\Controllers;

use App\Handler\FindReservationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Busca una reserva por numero de reserva o nombre
     * de cliente
     *
     * @param $numberOrName
     * @return JsonResponse
     */
    public function findReservation($numberOrName)
    {
        $handler = new FindReservationHandler(['numberOrName' => $numberOrName]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
