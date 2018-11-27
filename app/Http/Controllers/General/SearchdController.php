<?php

namespace App\Http\Controllers\General;

use App\Handler\GeneralHandlers\FindApartmentsByLocationHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
    
class SearchdController extends Controller{


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

}