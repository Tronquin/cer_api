<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;
use App\Location;
use App\Photo;

class FindExperiencesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiences = [];
        $ubicacionId = $this->params['ubicacion_id'];

        if (is_null($ubicacionId)) {
            // Obtengo las experiencias de la ubicacion predeterminada
            $location = Location::query()->whereRaw('default_experience = true')->first();
            $ubicacionId = $location->ubicacion_id;
        }

        $experiencesCollection = Experience::where('ubicacion_id', $ubicacionId)
            ->where('type', 'erp')
            ->with(['child', 'extras', 'apartamentos'])
            ->orderBy('experiencia_id')
            ->get();

        $extras = Extra::where('ubicacion_id', $ubicacionId)
            ->where('type', 'erp')    
            ->with(['child'])
            ->limit(5)
            ->get();
            
        foreach ($experiencesCollection as $expErp) {

            $webOrErp = $expErp->child ? $expErp->child->toArray() : $expErp->toArray();

            if ($webOrErp['front_page']) {
                $webOrErp['front_page'] = route('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_page'])]);
            }

            $extraIds = [];
            $available = [];
            foreach ($expErp->extras as $extraErp) {

                $temp = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();

                $temp['front_image'] = $temp['front_image'] ? route('storage.image', ['image' => str_replace('/', '-', $temp['front_image'])]) : null;
                $temp['icon'] = $temp['icon'] ? route('storage.image', ['image' => str_replace('/', '-', $temp['icon'])]) : null;
                
                $temp['fieldTranslations'] = $extraErp->child ? $extraErp->child->fieldTranslations() : $extraErp->fieldTranslations();

                $available[] = $temp;
                $extraIds[] = $extraErp->id;
            }

            $noAvailable = [];
            foreach ($extras as $extraErp) {
                if (! in_array($extraErp->id, $extraIds)) {

                    $temp = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();

                    $temp['front_image'] = $temp['front_image'] ? route('storage.image', ['image' => str_replace('/', '-', $temp['front_image'])]) : null;
                    $temp['icon'] = $temp['icon'] ? route('storage.image', ['image' => str_replace('/', '-', $temp['icon'])]) : null;
                    
                    $temp['fieldTranslations'] = $extraErp->child ? $extraErp->child->fieldTranslations() : $extraErp->fieldTranslations();

                    $noAvailable[] = $temp;
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

            $webOrErp['fieldTranslations'] = $expErp->child ? $expErp->child->fieldTranslations() : $expErp->fieldTranslations();

            $experiences[] = $webOrErp;
        }

        $response['res'] = count($experiences);
        $response['msg'] = 'experiencias de la ubicacion: '.$ubicacionId;
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

        ];
    }

}