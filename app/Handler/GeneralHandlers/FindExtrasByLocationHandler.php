<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Handler\BaseHandler;
use App\Service\ERPService;

class FindExtrasByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $extrasWeb = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','web')->get();
        
        if(count($extrasWeb)){
            foreach($extrasWeb as $ew){
                $extrasWebArray[] = $ew->getOriginal();
                $dataEW[] = $ew->extra_id;
            }
        }else{
            $extrasWebArray=[];
        }

        if(isset($dataEW)){
            $extrasErp = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->whereNotIn('extra_id',$dataEW)->get();
        }else{
            $extrasErp = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->get();
        }
        if(count($extrasErp)){
            foreach($extrasErp as $ee){
                $extrasErpArray[] = $ee->getOriginal();
            }
        }else{
            $extrasErpArray = [];
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