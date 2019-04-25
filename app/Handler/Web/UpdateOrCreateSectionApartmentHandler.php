<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\PhotoAndMoreSection;
use App\SectionApartment;
use App\Location;
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

            $location = Location::where('ubicacion_id',$this->params['ubicacion_id'])->firstOrFail();
            $section = SectionApartment::query()->findOrNew($id);
            $section->ubicacion_id = $this->params['ubicacion_id'];
            $section->order = isset($sectionApartment['order']) ? $sectionApartment['order'] : null;

            $sectionApartment_Name = '';
            foreach($section->fieldTranslations() as $iso){
                if($iso['iso'] === 'en'){
                    foreach($iso['fields'] as $sectionApartmentImage){
                        if($sectionApartmentImage['field'] === 'name')
                        $sectionApartment_Name = $sectionApartmentImage['translation'];
                    }
                }
            }
            $front_image_name = $location->pais.'_'.$location->ciudad.'_sectionApartment_img_'.$sectionApartment_Name.'_';
            $icon = $location->pais.'_'.$location->ciudad.'_sectionApartment_icon_'.$sectionApartment_Name.'_';

            if (isset($sectionApartment['photo'])) {
                $path = UploadImage::upload($sectionApartment['photo'], 'sectionApartment/',$front_image_name);
                $section->photo =  $path;
            }

            $data['fieldTranslations'] = $section->fieldTranslations();
            $section->save();

            $section->photo = urldecode(route('storage.image', ['image' => str_replace('/', '-', $section->photo)]));
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
