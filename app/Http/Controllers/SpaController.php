<?php

namespace App\Http\Controllers;

use App\Handler\GetSpaInfoHandler;
use App\Handler\UpdateSpaInfoHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    /**
     * Obtiene informacion del SPA
     *
     * @param $location_id
     * @return JsonResponse
     */
    public function info($location_id)
    {
        $handler = new GetSpaInfoHandler(['location_id' => $location_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Actualiza informacion del SPA
     *
     * @param $location_id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request,$location_id)
    {
        $data = $request->all();
        $data['location_id'] = $location_id;
        
        $handler = new UpdateSpaInfoHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
