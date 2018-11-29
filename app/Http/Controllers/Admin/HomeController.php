<?php

namespace App\Http\Controllers\Admin;

use App\Handler\Web\SaveExtrasHandler;
use App\Handler\Web\FindExtrasByLocationHandler;
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

    /**
    * Busca los extras de una Ubicacion en "local"
    * @param $ubicacion_id
    * @return mixed
    */
    public function findExtrasByLocation($ubicacion_id){
        $handler = new FindExtrasByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    

}