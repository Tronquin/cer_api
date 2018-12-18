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
     * @return JsonResponse
     */
    public function info()
    {
        $handler = new GetSpaInfoHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Actualiza informacion del SPA
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $handler = new UpdateSpaInfoHandler($request->all());
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
