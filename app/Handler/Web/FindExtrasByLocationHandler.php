<?php
namespace App\Handler\Web;

use App\Extra;
use App\Handler\BaseHandler;
use Illuminate\Support\Facades\DB;

class FindExtrasByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $extrasErp = Extra::where('ubicacion_id','=',$this->params['ubicacion_id'])->where('type','=','erp')->get();
        
        if(count($extrasErp)){
            $response['res'] = count($extrasErp);
            $response['msg'] = 'extras de la ubicacion: '.$this->params['ubicacion_id'];
            $response['data'] = $extrasErp;
        }else{
            $response['res'] = 0;
            $response['msg'] = 'Extras no encontrados';
            $response['data'] = [];
        }
       
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