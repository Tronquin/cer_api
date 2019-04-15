<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\ExtraOustanding;
use App\Handler\Web\UpdateOrCreateExtraOustandingHandler;

class ExtrasOustandingController extends Controller
{
    /**
    * consulta los datos de los Extras Oustandings
    * @param $location_id
    * @return mixed
    */
    public function getExtras($location_id)
    {
        $data = [];
        $Translation = new ExtraOustanding();
        $Translation->fieldTranslation = $Translation->fieldTranslations();
        
        $extras = ExtraOustanding::where('location_id', $location_id)->get();
        foreach ($extras as &$extra) {
            $extra->photo = route('storage.image', ['image' => str_replace('/', '-', $extra['photo'])]);
            $extra->icon = route('storage.image', ['image' => str_replace('/', '-', $extra['icon'])]);
            $extra['fieldTranslations'] = $extra->fieldTranslations();
        }

        if (count($extras)) {
            $data['oustandings'] = $extras;
            $data['fieldTranslations'] = $Translation->fieldTranslation;

            $response = [
                'res' => count($extras),
                'msg' => "Informacion encontrada",
                'data' => $data,
            ];
        } else {
            $data['oustandings'] = [];
            $data['fieldTranslations'] = $Translation->fieldTranslation;

            $response = [
                'res' => 0,
                'msg' => "Informacion no encontrada",
                'data' => $data,
            ];
        }
        return new JsonResponse($response);
    }
    
    /**
    * Actualiza los Extras Oustandings
    * @param Request $request
    * @param $location_id
    * @return mixed
    */
    public function updateOrCreateExtras(Request $request, $location_id)
    {
        $data = $request->all();
        $data['location_id'] = $location_id;
        $handler = new UpdateOrCreateExtraOustandingHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    public function destroyDocument(Request $request, $document_id)
    {
        $document = ExtraOustanding::where('id', '=', $document);
        $document->document = "";
        $document->document_name = "";

        return ['response' => 'Documento Eliminado'];
    }
}
