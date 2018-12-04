<?php

namespace App\Http\Controllers\Admin;

use App\Handler\Web\SaveExtrasHandler;
use App\Handler\Web\FindExtrasByLocationHandler;
use App\Handler\Web\FindExperiencesByLocationHandler;
use App\Http\Controllers\Controller;
use App\Location;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * guarda los cambios de los extras de una Ubicacion
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
    * Busca los extras de una Ubicacion en "version erp"
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

    /**
    * Busca las experiencias de una Ubicacion en "version erp"
    * @param $ubicacion_id
    * @return mixed
    */
    public function findExperiencesByLocation($ubicacion_id){
        $handler = new FindExperiencesByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }    

}