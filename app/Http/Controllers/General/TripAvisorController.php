<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\GeneralHandlers\FindTripAvisorHandler;

class TripAvisorController extends Controller
{

    /**
     * Busca los datos de tripavisor
     *
     * @return JsonResponse
     */
    public function findTripAvisor(){

        $handler = new FindTripAvisorHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}