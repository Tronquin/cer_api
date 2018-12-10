<?php

namespace App\Http\Controllers;

use App\Handler\Web\CreateGaleryHandler;
use App\Handler\Web\FindGaleryERPHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Crea una nueva Galeria
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $handler = new CreateGaleryHandler(['data' => $data]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
    * Busca las imagenes obtenidas del erp
    * @return mixed
    */
    public function erpGalery(){
        
        $handler = new FindGaleryERPHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    } 
}
