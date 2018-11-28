<?php

namespace App\Http\Controllers\General;

use App\Handler\GeneralHandlers\FindApartmentsByLocationHandler;
use App\Handler\GeneralHandlers\FindApartmentsDisponibilityHandler;
use App\Handler\GeneralHandlers\FindPriceByNightHandler;
use App\Handler\GeneralHandlers\FindPOIByLocationHandler;
use App\Handler\GeneralHandlers\FindExperiencesByLocationHandler;
use App\Handler\GeneralHandlers\FindExtrasByLocationHandler;
use App\Handler\GeneralHandlers\FindTypologyByLocationHandler;
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

    /**
     * Busca los POI por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findPOIByLocation($ubicacion_id){

        $handler = new FindPOIByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    
    /**
     * Busca las experiencias por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findExperiencesByLocation($ubicacion_id){

        $handler = new FindExperiencesByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los extras por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findExtrasByLocation($ubicacion_id){

        $handler = new FindExtrasByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los extras por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findTypologyByLocation($ubicacion_id){

        $handler = new FindTypologyByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}