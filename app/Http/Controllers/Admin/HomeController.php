<?php

namespace App\Http\Controllers\Admin;

use App\Handler\FindExperienceHandler;
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
    * @param $ubicacion_id
    * @return mixed
    */
    public function allExperiencesByLocation($ubicacion_id){
        $handler = new FindExperienceHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    public function getAllExtras($ubicacion_id){
        
        $response = [];
        $res = Location::find($ubicacion_id)->extras;
        $response['res'] = 1;
        $response['msg'] = "extras encontrados";
        $response['data'] = $res;

        return new JsonResponse($response);
    }
    

}