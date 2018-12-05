<?php

namespace App\Http\Controllers;

use App\Handler\LanguageDeviceHandler;
use App\Handler\ListTranslationHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LanguageController extends Controller
{
    /**
     * Obtiene la lista de idiomas disponibles con
     * su traduccion
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listTranslation(Request $request)
    {
        $handler = new ListTranslationHandler(['device' => $request->device]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Todos los idiomas con su traduccion por dispositivo
     *
     * @return JsonResponse
     */
    public function languageDevice()
    {
        $handler = new LanguageDeviceHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
