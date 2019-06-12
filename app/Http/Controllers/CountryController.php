<?php

namespace App\Http\Controllers;

use App\Handler\GetCountryHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Get countries
     *
     * @return JsonResponse
     */
    public function index()
    {
        $handler = new GetCountryHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
