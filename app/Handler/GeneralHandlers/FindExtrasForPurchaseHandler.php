<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;
use App\Photo;
use App\Service\UrlGenerator;

class FindExtrasForPurchaseHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiences = [];
        $webOrErp = [];

        $experienceCollection = Experience::where('experiencia_id',$this->params['experiencia_id'])
            ->where('type', 'erp')
            ->with(['child', 'extras'])
            ->get();
            
        $extras = Extra::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')    
            ->with(['child'])
            ->limit(10)
            ->get();
            
        foreach($experienceCollection as $expErp){
            
            $extraIds = [];
            $available = [];
            foreach ($expErp->extras as $extraErp) {

                $extraIds[] = $extraErp->id;
            }

            $noAvailable = [];
            foreach ($extras as $extraErp) {
                if (! in_array($extraErp->id, $extraIds)) {

                    $temp = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();

                    $temp['front_image'] = $temp['front_image'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['front_image'])]) : null;
                    $temp['icon'] = $temp['icon'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['icon'])]) : null;
                    $temp['precio'] = Extra::calcularIva($temp['base_imponible'],$temp['iva_tipo']);

                    if($temp['is_published'])
                    $webOrErp[] = $temp;
                }
            }
        
        }
        
        $response['res'] = count($webOrErp);
        $response['msg'] = 'extras para contratar';
        $response['data'] = $webOrErp;
       
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