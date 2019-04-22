<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\PhotoAndMoreSection;
use App\SectionApartment;
use App\Service\UploadImage;

class UpdateOrCreateSectionApartmentHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $sectionApartmentIds = [];
        
        foreach ($this->params['sectionApartments'] as $sectionApartment) {
            $id = $sectionApartment['id'];

            $section = SectionApartment::query()->findOrNew($id);
            $section->ubicacion_id = $this->params['ubicacion_id'];
            $section->order = isset($sectionApartment['order']) ? $sectionApartment['order'] : null;

            if (isset($sectionApartment['photo']) && $section->photo->wasChanged()) {
                $path = UploadImage::upload($sectionApartment['photo'], 'sectionApartment/');
                $section->photo =  $path;
            }

            $data['fieldTranslations'] = $section->fieldTranslations();
            $section->save();

            $section->photo = route('storage.image', ['image' => str_replace('/', '-', $section->photo)]);
            $section->updateFieldTranslations($sectionApartment['fieldTranslations']);
            $section['fieldTranslations'] = $section->fieldTranslations();
            $data['sectionApartments'][] = $section;
            $sectionApartmentIds[] = $section->id;
        }

        // Elimino todas las secciones que no llegaron de front
        PhotoAndMoreSection::query()
            ->whereNotIn('section_apartment_id', $sectionApartmentIds)
            ->whereNotNull('section_apartment_id')
            ->delete();
        SectionApartment::query()->whereNotIn('id', $sectionApartmentIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
        ];

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
            'sectionApartments' => 'required'
        ];
    }
}
