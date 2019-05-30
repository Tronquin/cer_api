<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Handler\Web\UpdateOrCreateCancellationPolicyHandler;
use Illuminate\Http\Request;
use App\CancellationPolicy;

class CancellationPolicyController extends Controller
{
   
    /**
    * Actualiza las politicas de cancelacion
    * @param Request $request 
    * @return mixed
    */
    public function updateOrCreateCancellationPolicy(Request $request){

        $data = $request->all();
        $handler = new UpdateOrCreateCancellationPolicyHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}