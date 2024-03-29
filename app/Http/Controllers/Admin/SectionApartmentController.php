<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\SectionApartment;
use App\Location;
use App\Service\UrlGenerator;
use App\Handler\Web\UpdateOrCreateSectionApartmentHandler;

class SectionApartmentController extends Controller
{
    /**
    * consulta los datos de las SectionApartment
    * @return mixed
    * @param $location_id
    */
    public function getSectionApartment($location_id){

        $data = [];
        $Translation = new SectionApartment();
        $location = Location::where('ubicacion_id',$location_id)->first();
        $data['location'] = $location->fieldTranslations;

        $sectionApartments = SectionApartment::where('location_id', $location->id)->with('extras')->orderBy('order')->get();
        foreach ($sectionApartments as &$sectionApartment){
            $sectionApartment['photo'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $sectionApartment->photo)]);
            $sectionApartment['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $sectionApartment->icon)]);

            foreach($sectionApartment->extras as &$extra){
                $extra['precio'] = $extra->calcularIva($extra->base_imponible,$extra->iva_tipo);
                $extra['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra['icon'])]);
                $extra['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra['front_image'])]);
            }
        }

        $data['fieldTranslations'] = $Translation->fieldTranslation;

        if(! count($sectionApartments)){

            $data['sectionApartments'] = [];

            return new JsonResponse(['res' => 0, 'msg' => "Informacion no encontrada", 'data' => $data]);
        }

        $data['sectionApartments'] = $sectionApartments;

        return new JsonResponse([
            'res' => count($sectionApartments),
            'msg' => "Secciones encontradas para la ubicacion",
            'data' => $data,
        ]);
    }
    
    /**
    * Actualiza las SectionApartment
    * @param Request $request 
    * @param $ubicacion_id
    * @return mixed
    */
    public function updateOrCreateSectionApartment(Request $request,$ubicacion_id){

        $data = $request->all();
        $data['location_id'] = $ubicacion_id;
        
        $handler = new UpdateOrCreateSectionApartmentHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}