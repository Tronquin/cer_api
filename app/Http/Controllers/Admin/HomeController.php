<?php

namespace App\Http\Controllers\Admin;

use App\Handler\Web\SaveExtrasHandler;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Busca la experiencias de una Ubicacion
    * @param Request $request
    * @return mixed
    */
    public function saveExtras(Request $request){
        $handler = new SaveExtrasHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    

}