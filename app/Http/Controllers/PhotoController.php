<?php

namespace App\Http\Controllers;

use App\Handler\GetPhotoByGallery;
use App\Handler\GetPhotoByGalleryByLocation;
use App\Handler\Web\FindGaleryERPHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\Web\CreatePhotoHandler;

class PhotoController extends Controller
{
    /**
     * Guarda una nueva foto
     *
     * @param Request $request
     * @param string $galleryCode
     * @return JsonResponse
     */
    public function create(Request $request, $galleryCode)
    {
        $data = $request->all();
        $data['galleryCode'] = $galleryCode;

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

    /**
     * Obtiene las imagenes de una galeria
     *
     * @param string $galleryCode
     * @return JsonResponse
     */
    public function photos($galleryCode)
    {
        $handler = new GetPhotoByGallery(compact('galleryCode'));
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene las imagenes de una galeria
     *
     * @param string $ubicacionId
     * @return JsonResponse
     */
    public function photosByLocation($ubicacionId)
    {
        $handler = new GetPhotoByGalleryByLocation(compact('ubicacionId'));
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
