<?php

namespace App\Http\Controllers;

use App\Handler\GetRolHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Get roles
     *
     * @return JsonResponse
     */
    public function getRoles()
    {
        $handler = new GetRolHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
