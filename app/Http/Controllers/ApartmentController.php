<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Busca todos los apartamentos de una ubicacion
     *
     * @param $id
     * @return JsonResponse
     */
    public function findApartment($id)
    {
        $handler = new FindApartmentHandler(['ubicacion_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}