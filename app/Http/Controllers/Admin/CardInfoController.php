<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Service\UrlGenerator;
use App\Handler\Web\UpdateOrCreateCardInfoHandler;
use Illuminate\Http\Request;
use App\CardInfo;

class CardInfoController extends Controller
{
    /**
    * consulta los datos de las cards
    * @return mixed
    */
    public function getCardInfo(){

        $data = [];
        $Translation = new CardInfo();
        
        $cardInfo = CardInfo::all();
        foreach ($cardInfo as &$card){
            $card->front_image = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $card['front_image'])]);
        }

        if(count($cardInfo)){
            $data['cards'] = $cardInfo;
            $data['fieldTranslations'] = $Translation->fieldTranslation;

            $response = [
                'res' => count($cardInfo),
                'msg' => "Informacion encontrada",
                'data' => $data,
            ];
        }else{
            $data['cards'] = [];
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
    * Actualiza las cardsInfo
    * @param Request $request 
    * @return mixed
    */
    public function updateOrCreateCardInfo(Request $request){

        $data = $request->all();
        $handler = new UpdateOrCreateCardInfoHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}