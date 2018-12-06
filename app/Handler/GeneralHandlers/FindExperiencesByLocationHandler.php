<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;
use App\Photo;

class FindExperiencesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiences = [];

        $experiencesCollection = Experience::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child', 'extras', 'apartamentos','galeria'])
            ->get();

        $extras = Extra::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')    
            ->with(['child'])
            ->limit(5)
            ->get();
            
        foreach ($experiencesCollection as $expErp) {

            $webOrErp = $expErp->child ? $expErp->child->toArray() : $expErp->toArray();

            $extraIds = [];
            $available = [];
            foreach ($expErp->extras as $extraErp) {
                $available[] = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();
                $extraIds[] = $extraErp->id;
            }

            $noAvailable = [];
            foreach ($extras as $extraErp) {
                if (! in_array($extraErp->id, $extraIds)) {
                    $noAvailable[] = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();
                }
            }

            unset($webOrErp['extras']);
            $webOrErp['extras']['disponibles'] = $available;
            $webOrErp['extras']['no_disponibles'] = $noAvailable;

            $aparments = [];
            foreach ($expErp->apartamentos as $aparmentErp) {
                $aparments[] = $aparmentErp->child ? $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }

            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] = $aparments;

            $galeries = $expErp->galeria->child ? $expErp->galeria->child->toArray() : $expErp->galeria->toArray();
            
            unset($webOrErp['galeria']);
            $webOrErp['galeria'] = $galeries;
            
            $photos = [];
            foreach ($expErp->galeria->fotos as $fotosErp) {
                $photos[] = $fotosErp->child ? $fotosErp->child->toArray() : $fotosErp->toArray();
            }

            unset($webOrErp['galeria']['fotos']);
            $webOrErp['galeria']['fotos'] = $photos;

            $experiences[] = $webOrErp;
        }

        $response['res'] = count($experiences);
        $response['msg'] = 'experiencias de la ubicacion: '.$this->params['ubicacion_id'];
        $response['data'] = $experiences;
       
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