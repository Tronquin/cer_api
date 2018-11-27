<?php

namespace App\Http\Controllers\General;

use App\Handler\GeneralHandlers\FindApartmentsByLocationHandler;
use App\Handler\GeneralHandlers\FindApartmentsDisponibilityHandler;
use App\Handler\GeneralHandlers\FindPriceByNightHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
    
class SearchdController extends Controller
{

    /**
     * Busca todos los apartamentos de una ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findApartmentsByLocation($ubicacion_id){

        $handler = new FindApartmentsByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca la disponibilidad de los apartamentos por fechas y personas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findApartmentsDisponibility(Request $request){

        $request = $request->all();
        $handler = new FindApartmentsDisponibilityHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los precios por noche y precio total de la reserva segun params
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findPriceByNight(Request $request){

        $request = $request->all();
        $handler = new FindPriceByNightHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}