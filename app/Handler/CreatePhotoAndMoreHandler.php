<?php
namespace App\Handler;

use App\Galery;
use App\Location;
use App\PhotoAndMore;
use App\PhotoAndMoreSection;

class CreatePhotoAndMoreHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $location = Location::query()->where('ubicacion_id', $this->params['ubicacionId'])->firstOrFail();

        $photoAndMore = PhotoAndMore::query()->with(['sections'])->where('location_id', $location->id)->firstOrNew([]);
        $photoAndMore->video = $this->params['video'];
        $photoAndMore->save();

        $photoAndMore->updateFieldTranslations($this->params['fieldTranslations']);

        $sectionIds = [];
        foreach ($this->params['sections'] as $section) {

            $sectionInstance = PhotoAndMoreSection::query()->findOrNew($section['id'] ?? 0);

            if (! isset($section['id'])) {
                // Creo una nueva seccion con su galeria
                $gallery = new Galery();
                $gallery->code = 'photoAndMore.location.' . $location->ubicacion_id . '.' . uniqid();
                $gallery->save();

                $sectionInstance->gallery_id = $gallery->id;
            }

            $sectionInstance->video = $section['video'];
            $sectionInstance->save();

            $sectionInstance->updateFieldTranslations($section['fieldTranslations']);

            $sectionIds[] = $sectionInstance->id;
        }

        PhotoAndMoreSection::query()->whereNotIn('id', $sectionIds)->delete();

        return [
            'res' => 1,
            'msg' => 'Fotos y Mas Actualizado',
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
        return [
            'video' => 'required',
            'location_id' => 'required',
            'fieldTranslations' => 'required',
            'ubicacionId' => 'required'
        ];
    }

}