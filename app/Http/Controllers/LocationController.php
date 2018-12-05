<?php

namespace App\Http\Controllers;

use App\Handler\UpdateLocationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Actualiza una ubicacion
     *
     * @param Request $request
     * @param $locationId
     * @return JsonResponse
     */
    public function update(Request $request, $locationId)
    {
        $data = $request->all();
        $data['locationId'] = $locationId;

        $handler = new UpdateLocationHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
