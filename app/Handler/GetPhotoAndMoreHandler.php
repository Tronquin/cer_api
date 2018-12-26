<?php
namespace App\Handler;

use App\Location;
use App\PhotoAndMore;

class GetPhotoAndMoreHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $location = Location::query()->where('ubicacion_id', $this->params['ubicacionId'])->firstOrFail();

        $photoAndMore = PhotoAndMore::query()
            ->with(['sections.gallery'])
            ->where('location_id', $location->id)
            ->first();

        if (! $photoAndMore) {
            $photoAndMore = new PhotoAndMore();
            $photoAndMore->video = '';
            $photoAndMore->location_id = null;
            $photoAndMore->sections = [];
            $photoAndMore->fieldTranslations = $photoAndMore->fieldTranslations();
        }

        foreach ($photoAndMore->sections as $section) {
            $section->fieldTranslations = $section->fieldTranslations();
        }

        return [
            'res' => 1,
            'msg' => 'Informacion de Fotos y Mas',
            'data' => [
                compact('photoAndMore')
            ]
        ];
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