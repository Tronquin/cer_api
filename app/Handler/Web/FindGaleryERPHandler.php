<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use Illuminate\Support\Facades\DB;
use App\Photo;

class FindGaleryERPHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $fotosERP = photo::where('type','erp')->get()->toArray();
       
        if ($fotosERP){
            $response['res'] = count($fotosERP);
            $response['msg'] = 'imagenes de Erp';
            $response['data'] = $fotosERP;
        }else{
            $response['res'] = 0;
            $response['msg'] = 'imagenes no encontradas';
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
           
        ];
    }

}