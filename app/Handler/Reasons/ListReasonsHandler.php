<?php
namespace App\Handler\Reasons;

use App\ReasonsInfo;
use App\Handler\BaseHandler;
use App\Service\UrlGenerator;

class ListReasonsHandler extends BaseHandler {

    /**
     * Handler que devuelve un listado de Razones para reservar
     * Proceso de este handler
     */
    protected function handle()
    {

        $location_id = isset($this->params['location_id']) ? $this->params['location_id'] : null;
        $reasonsInfo = ReasonsInfo::where('location_id',$location_id)
                        ->with('reasons')->orderBy('id', 'asc')->get()->toArray();

        foreach ($reasonsInfo as &$info){
            $info['main_photo'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $info['main_photo'])]);
            $info['description_photo'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $info['description_photo'])]);
            foreach($info['reasons'] as &$reason){
                $reason['photo'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $reason['photo'])]);
                $reason['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $reason['icon'])]);
            }
        }
               
        
        return ['res' => 1, 'msg' => 'razones encontradas', 'data' => $reasonsInfo];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [];
    }

}