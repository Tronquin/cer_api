<?php
namespace App\Handler\Web;

use App\Extra;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FindExtrasByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $extrasWeb = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','web')->get();
        foreach($extrasWeb as $ew){
            $extrasWebArray[] = $ew->getOriginal();
            $dataEW[] = $ew->extra_id;
        }
        if(isset($dataEW)){
            $extrasErp = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->whereNotIn('extra_id',$dataEW)->get();
        }else{
            $extrasErp = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->get();
        }
        foreach($extrasErp as $ee){
            $extrasErpArray[] = $ee->getOriginal();
        }
        $extras = array_merge($extrasWebArray,$extrasErpArray);
        $response['res'] = count($extras);
        $response['msg'] = 'extras de la ubicacion: '.$this->params['ubicacion_id'];
        $response['data'] = $extras;
       
        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'ubicacion_id' => 'required|numeric'
        ];
    }

}