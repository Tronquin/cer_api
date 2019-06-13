<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\FrequentQuestion;
use App\Handler\Web\UpdateOrCreateFrequentQuestionHandler;

class FrequentQuestionController extends Controller
{
    /**
    * consulta los datos de las FrequentQuestions
    * @return mixed
    */
    public function getFrequentQuestions(){

        $data = [];
        $Translation = new FrequentQuestion();
        $Translation->fieldTranslation = $Translation->fieldTranslations();
        
        $frequentQuestions = FrequentQuestion::orderBy('order')->get();
        foreach ($frequentQuestions as &$frequentQuestion){
            $frequentQuestion['fieldTranslations'] = $frequentQuestion->fieldTranslations();

            $locations = [];

            if ($frequentQuestion->main_web) {
               $locations[] = [
                                'id'=> '',
                                'castro'  => true,
                                'text' => 'Castro Exclusive Residences'
                            ]; 
            }
            foreach ($frequentQuestion->locations as $location) {
                $locations[] = [
                                'id'=> $location->pivot->location_id,
                                'castro'  => false,
                                'text' => $location->nombre
                            ];
            }

            $frequentQuestion['tags'] = $locations;
        }

        if(count($frequentQuestions)){
            $data['questions'] = $frequentQuestions;
            $data['fieldTranslations'] = $Translation->fieldTranslation;

            $response = [
                'res' => count($frequentQuestions),
                'msg' => "Preguntas encontradas",
                'data' => $data,
            ];
        }else{
            $data['questions'] = [];
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
    * Actualiza las FrequentQuestion
    * @param Request $request 
    * @return mixed
    */
    public function updateOrCreateFrequentQuestion(Request $request){

        $data = $request->all();
        $handler = new UpdateOrCreateFrequentQuestionHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}