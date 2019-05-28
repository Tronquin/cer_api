<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;
use App\Service\UrlGenerator;

class FindLocationsHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $locations = Location::where('type', 'erp')
            ->with(['child','tipologias','spas'])
            ->orderBy('id')
            ->get();
        
        $LocationwebOrErp = [];
        foreach ($locations as $locationErp) {
            $temp = $locationErp->child ? $locationErp->child->toArray() : $locationErp->toArray();
            $tempObject = $locationErp->child ? $locationErp->child : $locationErp;

            $temp['front_page'] = $this->generateImageUrl($temp['front_page']);
            $temp['domain_logo'] = $this->generateImageUrl($temp['domain_logo']);
            $temp['marker'] = $this->generateImageUrl($temp['marker']);
            $temp['fieldTranslations'] = $locationErp->fieldTranslations();
            $temp['logo'] = $this->generateImageUrl($temp['logo']);
            $temp['slug'] = str_slug($locationErp->nombre);

            $tipologias = [];
            foreach($tempObject->tipologias as $tipologia){
                $tipologias[] = $tipologia->child ? $tipologia->child->toArray() : $tipologia->toArray();
            }
            $temp['tipologias'] = $tipologias;

            foreach($tempObject->spas as &$spa){
                $spa['fieldTranslations'] = $spa->fieldTranslations();
            }
            $temp['spas'] = $tempObject->spas;

            $LocationwebOrErp[] = $temp;
        }

        return $LocationwebOrErp;
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

    /**
     * Genera la url hacia las imagenes
     *
     * @param string $path
     * @return string
     */
    private function generateImageUrl($path)
    {
        if (! $path) {
            return null;
        }

        $path = str_replace('/', '-', $path);
        $path = UrlGenerator::generate('storage.image', ['image' => $path]);

        return $path ;
    }
}