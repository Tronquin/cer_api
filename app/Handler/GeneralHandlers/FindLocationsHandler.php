<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;

class FindLocationsHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $locations = Location::where('type', 'erp')
            ->with(['child'])
            ->get();
        
        $LocationwebOrErp = [];
        foreach ($locations as $locationErp) {
            $temp = $locationErp->child ? $locationErp->child->toArray() : $locationErp->toArray();
            $temp['front_page'] = $this->generateImageUrl($temp['front_page']);
            $temp['fieldTranslations'] = $locationErp->fieldTranslations();
            $temp['logo'] = $this->generateImageUrl($temp['logo']);

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
        $path = route('storage.image', ['image' => $path]);

        return $path ;
    }
}