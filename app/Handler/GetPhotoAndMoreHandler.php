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
            ->with(['sections.gallery.photos', 'sections.sectionApartment'])
            ->where('location_id', $location->id)
            ->first();

        if (! $photoAndMore) {
            $photoAndMore = new PhotoAndMore();
            $photoAndMore->video = '';
            $photoAndMore->location_id = null;
            $photoAndMore->sections = [];
        }

        $photoAndMore->fieldTranslations = $photoAndMore->fieldTranslations();

        $originalSections = [];
        $apartmentSections = [];
        foreach ($photoAndMore->sections as $section) {
            $section->fieldTranslations = $section->fieldTranslations();

            foreach ($section->gallery->photos as $photo) {
                $photo->url = route('storage.image', ['image' => str_replace('/', '-', $photo->url)]);
            }

            if ($section->sectionApartment) {

                $section->sectionApartment->photo = route('storage.image', ['image' => str_replace('/', '-', $section->sectionApartment->photo)]);
                $section->sectionApartment->fieldTranslations = $section->sectionApartment->fieldTranslations();

                $apartmentSections[] = $section;
            } else {
                $originalSections[] = $section;
            }
        }

        $apartmentSections = $this->orderArray($apartmentSections);

        $photoAndMore->originalSections = $originalSections;
        $photoAndMore->apartmentSections = $apartmentSections;

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

    /**
     * Ordena por seccion de apartamento
     *
     * @param array $array
     * @return array
     */
    private function orderArray($array)
    {
        for ($x = 0; $x <= count($array) - 2; $x++) {
            for ($y = ($x +1); $y <= count($array) - 1; $y++) {

                if ($array[$x]->sectionApartment->order > $array[$y]->sectionApartment->order) {

                    $temp = $array[$x];
                    $array[$x] = $array[$y];
                    $array[$y] = $temp;
                }
            }
        }

        return $array;
    }
}