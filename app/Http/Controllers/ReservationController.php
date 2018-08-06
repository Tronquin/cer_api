<?php

namespace App\Http\Controllers;

use App\Handler\ChangeReservationServiceHandler;
use App\Handler\ReservationCheckinHandler;
use App\Handler\FindReservationToCheckinHandler;
use App\Handler\FindReservationGuestHandler;
use App\Handler\SaveReservationGuestHandler;
use App\Handler\AddPassaport;
use App\Handler\FindReservationHandler;
use App\Handler\FindReservationByIdHandler;
use App\Handler\ChangeReservationRoomHandler;
use App\Handler\AvailabilityRoomHandler;
use App\Handler\ChangeReservationPaxHandler;
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
     * Realiza el checkin de la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function reservationCheckin($id)
    {
        $handler = new ReservationCheckinHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por localizador o apellido
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
     * Busca una reserva por id
     *
     * @param $id
     * @return JsonResponse
     */
    public function findReservationById($id)
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos disponibles para modificar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function availabilityRoom(Request $request)
    {
        $request = $request->all();
        $handler = new AvailabilityRoomHandler(['data' => $request]);
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
    public function changeReservation(Request $request)
    {
        $request = $request->all();

            if ($request['type'] == 'room') {
                $handler = new ChangeReservationRoomHandler(['reserva_id' => $request['reserva_id'], 'room_change' => $request['room']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            } elseif ($request['type'] == 'pax') {
                $handler = new ChangeReservationPaxHandler(['reserva_id' => $request['reserva_id'], 'pax_change' => $request['pax']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } elseif ($request['type'] == 'experience') {
                $handler = new ChangeReservationRoomHandler(['reserva_id' => $request['reserva_id'], 'experience_change' => $request['experience']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } elseif ($request['type'] == 'service') {
                    $handler = new ChangeReservationServiceHandler(['reserva_id' => $request['reserva_id'], 'service_change' => $request['services']]);
                    $handler->processHandler();

                    if ($handler->isSuccess()) {
                        return new JsonResponse($handler->getData());
                    }

                    return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            } elseif ($request['type'] == 'key') {
                $handler = new ChangeReservationRoomHandler(['reserva_id' => $request['reserva_id'], 'key_change' => $request['key']]);
                $handler->processHandler();

                if ($handler->isSuccess()) {
                    return new JsonResponse($handler->getData());
                }

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());

            } else {
                return new JsonResponse(['res' => 0, 'msg' => 'el tipo de modificacion no existe', 'data' => []]);
            }

    }

    /**
     * Busca los datos de los huespedes de una reserva
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findReservationGuest(Request $request)
    {
        $request = $request->all();
        $handler = new FindReservationGuestHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda los datos de los huespedes
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveReservationGuest(Request $request)
    {
        $request = $request->all();
        $handler = new SaveReservationGuestHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda la imagen del pasaporte
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addPassaport(Request $request)
    {
        $request = $request->all();
        $handler = new AddPassaportHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
