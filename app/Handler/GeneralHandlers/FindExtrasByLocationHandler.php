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
        $extrasCollection = Extra::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child'])
            ->get();

        foreach ($extrasCollection as $extErp) {
            $webOrErp = $extErp->child ? $extErp->child->toArray() : $extErp->toArray();
            $webOrErp['fieldTranslations'] = $extErp->child ? $extErp->child->fieldTranslations() : $extErp->fieldTranslations();

            $extras[] = $webOrErp;
        }
        
        foreach ($extras as &$extra) {
            $extra['icon'] = urldecode(route('storage.image', ['image' => str_replace('/', '-', $extra['icon'])]));
            $extra['front_image'] = urldecode(route('storage.image', ['image' => str_replace('/', '-', $extra['front_image'])]));
        }

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