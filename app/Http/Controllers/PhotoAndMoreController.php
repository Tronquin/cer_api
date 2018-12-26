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
    public function photoAndMore($ubicacionId)
    {
        $handler = new GetPhotoAndMoreHandler(compact('ubicacionId'));
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
     * @param $ubicacionId
     * @return JsonResponse
     */
    public function store(Request $request, $ubicacionId)
    {
        $data = $request->all();
        $data['ubicacionId'] = $ubicacionId;

        $handler = new CreatePhotoAndMoreHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
