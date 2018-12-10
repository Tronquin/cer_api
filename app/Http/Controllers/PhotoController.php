<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\Web\CreatePhotoHandler;

class PhotoController extends Controller
{
    /**
     * Guarda una nueva foto
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $handler = new CreatePhotoHandler(['data' => $data]);
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
