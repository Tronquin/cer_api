<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Handler\BaseHandler;

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
            ->get();

        $extras = [];
        foreach ($extrasCollection as $extra) {
            $extras[] = $extra->toArray();
        }
        
        foreach ($extras as &$extra) {
            $extra['icon'] = route('storage.image', ['image' => str_replace('/', '-', $extra['icon'])]);
            $extra['front_image'] = route('storage.image', ['image' => str_replace('/', '-', $extra['front_image'])]);
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