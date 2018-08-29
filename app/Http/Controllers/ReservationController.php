<?php

namespace App\Http\Controllers;

use App\Handler\ReservationCheckinHandler;
use App\Handler\FindReservationToCheckinHandler;
use App\Handler\FindReservationGuestHandler;
use App\Handler\SaveReservationGuestHandler;
use App\Handler\AddPassaport;
use App\Handler\FindReservationHandler;
use App\Handler\FindReservationByIdHandler;
use App\Handler\AvailabilityRoomHandler;
use App\Handler\AvailabilityPlanHandler;
use App\Handler\AvailabilityExperienceHandler;
use App\Handler\AvailabilityServiceHandler;
use App\Handler\ReservationPaymentHandler;
use App\Handler\ReservationPersistenceHandler;
use App\Handler\ReservationGuestPersistenceHandler;
use App\Handler\ReservationFindPersistenceHandler;
use App\Handler\ScanGuestPassaportHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Busca todas las reservas por ubicacion_id y fecha
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
     * Realiza el checkin de una reserva
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
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findReservation($numberCodeOrName,$ubicacion_id)
    {
        $handler = new FindReservationHandler(['numberCodeOrName' => $numberCodeOrName,'ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por id por url
     *
     * @param $id
     * @return JsonResponse
     */
    public function findReservationById($id)
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $id,'method' => 2]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $response = $handler->getData();
            $handler = new ReservationFindPersistenceHandler(['reserva_id' => $id]);
            $handler->processHandler();
            if ($handler->isSuccess()) {
                $reservaUpdate = $handler->getData();
                $response['data']['list']['reservaUpdate'] = $reservaUpdate['data']['list'];
            }
            return new JsonResponse($response);
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por id por post
     *
     * @param $id
     * @return JsonResponse
     */
    public function reservationFindById($id)
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $id,'method' => 1]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de las habitaciones disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityRoom($id)
    {
        $handler = new AvailabilityRoomHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de los planes disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityPlan($id)
    {
        $handler = new AvailabilityPlanHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de las experiencias disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityExperience($id)
    {
        $handler = new AvailabilityExperienceHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de los servicios disponibles para la reserva
     *
     * @param id $id
     * @param funcion $funcion
     * @return JsonResponse
     */
    public function availabilityService($id,$funcion)
    {
        $handler = new AvailabilityServiceHandler(['reserva_id' => $id,'funcion' => $funcion]);
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
    public function reservationPersistence(Request $request)
    {
        $handler = new ReservationPersistenceHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
        return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    /**
     * Obtiene los datos modificados de la reserva
     *
     * @param id $id
     * @return JsonResponse
     */
    public function reservationFindPersistence($id)
    {
        $handler = new ReservationFindPersistenceHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
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
     * guarda los datos de los huespedes en cer-api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationGuestPersistence(Request $request)
    {

        $request = $request->all();

        $handler = new ReservationGuestPersistenceHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * envia la imagen del passaporte al erp y devuelve los datos decifrados
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function scanGuestPassaport(Request $request)
    {
        $request = $request->all();
        $handler = new ScanGuestPassaportHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Pago de la reserva para hacer el checkin
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationPayment(Request $request)
    {
        $request = $request->all();
        $handler = new ReservationPaymentHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
