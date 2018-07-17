<?php

namespace App\Http\Controllers;

use App\Handler\ChangeReservationServiceHandler;
use App\Handler\FindReservationToCheckinHandler;
use App\Handler\FindReservationHandler;
use App\Handler\ChangeReservationRoomHandler;
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

    /**
     * Modifica la reserva segun tipo
     * Recibe el parametro id de la reserva y dos parametros por request un string que indica el type
     * y un array que contiene los cambios a modificar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeReservation($numberOrCode, Request $request)
    {
        $request = $request->all();
        $reservation = $this->findReservation($numberOrCode);
        if($reservation->getData()) {
            $reservation = $reservation->getData()->data->list;

            if ($request['type'] == 'room') {
                $handler = new ChangeReservationRoomHandler(['reservation_id' => $reservation[0]->id, 'room_change' => $request['tipologia']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            } elseif ($request['type'] == 'pack') {
                $handler = new ChangeReservationRoomHandler(['reservation_id' => $reservation[0]->id, 'pack_change' => $request['pack']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } elseif ($request['type'] == 'experience') {
                $handler = new ChangeReservationRoomHandler(['reservation_id' => $reservation[0]->id, 'experience_change' => $request['experience']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } elseif ($request['type'] == 'service') {

                    $handler = new ChangeReservationServiceHandler(['reservation_id' => $reservation[0]->id, 'service_change' => $request['services']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        return new JsonResponse($handler->getData());
                    }

                    return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            } elseif ($request['type'] == 'key') {
                $handler = new ChangeReservationRoomHandler(['reservation_id' => $reservation[0]->id, 'key_change' => $request['key']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } else {
                return new JsonResponse(['res' => 0, 'msg' => 'el tipo de modificacion no existe', 'data' => []]);
            }
        }else{
            return new JsonResponse(['res' => 0, 'msg' => 'reservation no found', 'data' => []]);
        }

    }
}
