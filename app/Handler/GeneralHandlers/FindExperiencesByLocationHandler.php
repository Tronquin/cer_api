<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;

class FindExperiencesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiencesWeb = Experience::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','web')->get();
        
        if(count($experiencesWeb)){
            foreach($experiencesWeb as $ew){
                $experiencesWebArray[] = $ew->getOriginal();
                $dataEW[] = $ew->experiencia_id;
            }
        }else{
            $experienciesWebArray=[];
        }

        if(isset($dataEW)){
            $experienciesErp = Experience::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->whereNotIn('extra_id',$dataEW)->get();
        }else{
            $experienciesErp = Experience::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->get();
        }
        if(count($experienciesErp)){
            foreach($experienciesErp as $ee){
                $experienciesErpArray[] = $ee->getOriginal();
            }
        }else{
            $experienciesErpArray = [];
        }
        $experiencies = array_merge($experienciesWebArray,$experienciesErpArray);
        foreach($experiencies as $experiencias){
            $experiencias['extras'] = Experience::where('experiencia_id','=',$experiencias['experiencia_id'])->first()->extras;
        }
        
        $response['res'] = count($experiencies);
        $response['msg'] = 'experiencias de la ubicacion: '.$this->params['ubicacion_id'];
        $response['data'] = $experiencies;
       
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
            'ubicacion_id' => 'required|numeric',
        ];
    }

}