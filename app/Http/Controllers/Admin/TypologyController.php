<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Handler\Web\UpdateOrCreateTypologyHandler;
use Illuminate\Http\Request;
use App\Typology;

class TypologyController extends Controller
{
   
    /**
    * Actualiza las tipologias
    * @param Request $request 
    * @return mixed
    */
    public function updateOrCreateTypology(Request $request){

        $data = $request->all();
        $handler = new UpdateOrCreateTypologyHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}