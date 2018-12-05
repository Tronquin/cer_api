<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;

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

        $experiencia = [];
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

            $galeries = [];
            
            foreach ($expErp->galeria as $galeriesErp) {
                //$galeries[] = $galeriesErp->child ? $galeriesErp->child->toArray() : $galeriesErp->toArray();
            }

            //unset($webOrErp['galeria']);
            //$webOrErp['galeria'] = $galeries;


            $experiences[] = $webOrErp;
        }


/*
        $experiencia['galeria'] = Galery::where('galeria_id','=',$experiencia['galeria_id'])->where('type','=','web')->get();*/
        
        
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