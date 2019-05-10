<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\PhotoAndMoreSection;
use App\SectionApartment;
use App\Location;
use App\Service\UploadImage;
use App\Service\UrlGenerator;

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

            $location = Location::where('id',$this->params['location_id'])->firstOrFail();
            $section = SectionApartment::query()->with('extras')->findOrNew($id);
            $section->location_id = $this->params['location_id'];
            $section->order = isset($sectionApartment['order']) ? $sectionApartment['order'] : null;
            $section->show_web = isset($sectionApartment['show_web']) ? $sectionApartment['show_web'] : false;
            
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

            if (isset($sectionApartment['icon'])) {
                $path = UploadImage::upload($sectionApartment['icon'], 'sectionApartment/',$icon);
                $section->icon =  $path;
            }

            $data['fieldTranslations'] = $section->fieldTranslations();
            $section->save();

            $idExtras = [];
            foreach ($sectionApartment['extras'] as $extra){
                $idExtras[] = $extra['id'];
            }
            
            $section->extras()->sync($idExtras);

            $section->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $section->photo)]);
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
