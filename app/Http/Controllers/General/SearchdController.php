<?php

namespace App\Http\Controllers\General;

use App\Handler\FindExtraByTagHandler;
use App\Handler\FindMachineLogHandler;
use App\Handler\GeneralHandlers\FindApartmentsByLocationHandler;
use App\Handler\GeneralHandlers\FindApartmentsDisponibilityHandler;
use App\Handler\GeneralHandlers\FindExtrasOutstandingHandler;
use App\Handler\GeneralHandlers\FindPriceByNightHandler;
use App\Handler\GeneralHandlers\FindPOIByLocationHandler;
use App\Handler\GeneralHandlers\FindExperiencesByLocationHandler;
use App\Handler\GeneralHandlers\FindExtrasByLocationHandler;
use App\Handler\GeneralHandlers\FindSearchFavoriteHandler;
use App\Handler\GeneralHandlers\FindTypologyByLocationHandler;
use App\Handler\GeneralHandlers\FindPackagesByLocationHandler;
use App\Handler\GeneralHandlers\FindLocationsHandler;
use App\Handler\GeneralHandlers\FindExtrasForPurchaseHandler;
use App\Handler\GeneralHandlers\FindExtraByLocationTagHandler;
use App\Handler\GeneralHandlers\FindExtraByLocationTagChildrenHandler;
use App\Handler\GeneralHandlers\SaveMasiveExtraTagsHandler;
use App\Handler\SiteMapHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchdController extends Controller
{

    /**
     * Busca todos los apartamentos de una ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findApartmentsByLocation($ubicacion_id){

        $handler = new FindApartmentsByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca la disponibilidad de los apartamentos por fechas y personas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findApartmentsDisponibility(Request $request){

        $request = $request->all();
        $handler = new FindApartmentsDisponibilityHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los precios por noche y precio total de la reserva segun params
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findPriceByNight(Request $request){

        $request = $request->all();
        $handler = new FindPriceByNightHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los POI por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findPOIByLocation($ubicacion_id){

        $handler = new FindPOIByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    
    /**
     * Busca las experiencias por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findExperiencesByLocation($ubicacion_id = null){

        $handler = new FindExperiencesByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los extras por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
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
     * Busca los extras por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findExtrasOutstanding($ubicacion_id){

        $handler = new FindExtrasOutstandingHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los packs por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findPackagesByLocation($ubicacion_id){

        $handler = new FindPackagesByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los extras por ubicacion
     *
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findTypologyByLocation($ubicacion_id){

        $handler = new FindTypologyByLocationHandler(['ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    
    /**
     * Busca todas las ubicaciones
     *
     * @return JsonResponse
     */
    public function findLocations(){

        $handler = new FindLocationsHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los extras for purchase
     * @param $experiencia_id
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findExtrasForPurchase($experiencia_id,$ubicacion_id){
        
        $data = [];
        $data['experiencia_id'] = $experiencia_id;
        $data['ubicacion_id'] = $ubicacion_id;

        $handler = new FindExtrasForPurchaseHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene la busqueda que los usuario realizan con
     * mayor frecuencia
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findSearchFavorite(Request $request)
    {
        $handler = new FindSearchFavoriteHandler($request->all());
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene extras para cada tag
     *
     * @return JsonResponse
     */
    public function findExtraByTag()
    {
        $handler = new FindExtraByTagHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    
    /**
     * Obtiene extras para cada ubicacion segun el findExtraByLocationTag
     * al que pertenecen
     *
     * @param $ubicacion_id
     * @param $type
     * @return JsonResponse
     */
    public function findExtraByLocationTag($type,$ubicacion_id)
    {
        $handler = new FindExtraByLocationTagHandler(['ubicacion_id' => $ubicacion_id,'type' => $type]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene extras para cada ubicacion segun el findExtraByLocationTagChildren
     * al que pertenecen
     *
     * @param $type
     * @param $tagChildren
     * @return JsonResponse
     */
    public function findExtraByLocationTagChildren($type,$tagChildren)
    {
        $handler = new FindExtraByLocationTagChildrenHandler(['type' => $type,'tag_children' => $tagChildren]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Guarda los extras de forma masiva en los tags especificados
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveMasiveExtraTags(Request $request)
    {
        $data = $request->all();
        $handler = new SaveMasiveExtraTagsHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
    /**
     * Obtiene logs de la maquina
     *
     * @param int $limit
     * @return JsonResponse
     */
    public function machineLogs($limit = 10)
    {
        $handler = new FindMachineLogHandler(compact('limit'));
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene la informacion necesario para armar el sitemap
     *
     * @return JsonResponse
     */
    public function siteMap()
    {
        $handler = new SiteMapHandler();
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}