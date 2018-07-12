<?php

namespace App\Http\Controllers;

use App\Handler\FindReservationToCheckinHandler;
use App\Handler\FindReservationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Busca una reserva por ubicacion_id y fecha
     *
     * @param $id
     * @param $date
     * @return JsonResponse
     */
    public function findReservationToCheckin($id,$date)
    {
        $handler = new FindReservationToCheckinHandler(['ubicacion_id' => $id,'date' => $date]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por numero, codigo o nombre
     *
     * @param $numberCodeOrName
     * @return JsonResponse
     */
    public function findReservation($numberCodeOrName)
    {
        $handler = new FindReservationHandler(['numberCodeOrName' => $numberCodeOrName]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
