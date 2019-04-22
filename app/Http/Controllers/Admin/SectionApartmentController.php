<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\SectionApartment;
use App\Handler\Web\UpdateOrCreateSectionApartmentHandler;

class SectionApartmentController extends Controller
{
    /**
    * consulta los datos de las SectionApartment
    * @return mixed
    * @param $ubicacion_id
    */
    public function getSectionApartment($ubicacion_id){

        $data = [];
        $Translation = new SectionApartment();
        $Translation->fieldTranslation = $Translation->fieldTranslations();
        
        $sectionApartments = SectionApartment::where('ubicacion_id',$ubicacion_id)->orderBy('order')->get();
        foreach ($sectionApartments as &$sectionApartment){
            $sectionApartment['photo'] = route('storage.image', ['image' => str_replace('/', '-', $sectionApartment->photo)]);
            $sectionApartment['fieldTranslations'] = $sectionApartment->fieldTranslations();
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
        $data['ubicacion_id'] = $ubicacion_id;
        
        $handler = new UpdateOrCreateSectionApartmentHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}