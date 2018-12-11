<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Experience;

class FindExperiencesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $data = Experience::where('ubicacion_id','=',$this->params['ubicacion_id'])
            ->where('type','=','erp')->get();

        $response['res'] = count($data);
        $response['msg'] = 'Experiencias de la ubicacion '.$this->params['ubicacion_id'];
        $response['data'] = $data;

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