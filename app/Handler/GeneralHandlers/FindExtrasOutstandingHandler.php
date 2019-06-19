<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Handler\BaseHandler;
use App\Service\UrlGenerator;

class FindExtrasOutstandingHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $extrasCollection = Extra::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'web')
            ->where('outstanding', true)
            ->where('is_published', true)
            ->get();

        $extras = [];
        foreach ($extrasCollection as $key => $extra) {
            $extras[$key] = $extra->toArray();
        }
        
        foreach ($extras as &$extra) {
            $extra['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra['icon'])]);
            $extra['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra['front_image'])]);
        }

        $response['res'] = count($extras);
        $response['msg'] = 'extras destacados de la ubicacion: '.$this->params['ubicacion_id'];
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