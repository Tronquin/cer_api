<?php

namespace App\Http\Controllers;

use App\Handler\CreatePhotoAndMoreHandler;
use App\Handler\GetPhotoAndMoreHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhotoAndMoreController extends Controller
{
    /**
     * Obtener informacion de fotos y mas
     *
     * @param $ubicacionId
     * @return JsonResponse
     */
    public function photoAndMore($location_id)
    {
        $handler = new GetPhotoAndMoreHandler(compact('location_id'));
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Crea / Actualiza informacion de fotos y mas
     *
     * @param Request $request
     * @param $location_id
     * @return JsonResponse
     */
    public function store(Request $request, $location_id)
    {
        $data = $request->all();
        $data['location_id'] = $location_id;

        $handler = new CreatePhotoAndMoreHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
