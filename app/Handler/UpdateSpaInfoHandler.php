<?php
namespace App\Handler;

use App\Service\UploadImage;
use App\SpaInfo;
use App\SpaSection;
use App\SpaIcon;

class UpdateSpaInfoHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $spaInfo = SpaInfo::query()->firstOrNew([]);

        $spa_info_name = '';
        foreach($this->params['fieldTranslations'] as $iso){
            if($iso['iso'] === 'en'){
                foreach($iso['fields'] as $spaInfoName){
                    if($spaInfoName['field'] === 'name')
                    $spa_info_name = $spaInfoName['translation'];
                }
            }
        }
        $SpaInfophoto = 'spaInfo_img_'.$spa_info_name.'_';
        
        if (isset($this->params['photo'])) {
            // Imagen
            $path = UploadImage::upload($this->params['photo'], 'spa/',$SpaInfophoto);

            $spaInfo->photo = $path;
        }
        
        $spaInfo->save();
        $spaInfo->updateFieldTranslations($this->params['fieldTranslations']);
        
        $sectionIds = [];
        foreach ($this->params['spaSections'] as $spaSection) {

            $id = $spaSection['id'];

            $section = SpaSection::query()->findOrNew($id);
            $section->spa_info_id = $spaInfo->id;
            $section->name = $spaSection['name'];

            $spa_section_photo = 'spaSection_img_'.$spaSection['name'].'_';
            $spa_section_icon = 'spaSection_icon_'.$spaSection['name'].'_';

            if (isset($spaSection['photo'])) {
                // Imagen
                $path = UploadImage::upload($spaSection['photo'], 'spa/',$spa_section_photo);

                $section->photo = $path;
            }

            if (isset($spaSection['ico'])) {
                // Icon
                $path = UploadImage::upload($spaSection['ico'], 'spa/',$spa_section_icon);

                $section->ico = $path;
            }

            $section->save();
            
            $section->updateFieldTranslations($spaSection['fieldTranslations']);
            $sectionIds[] = $section->id;

            $iconIds = [];
            foreach($spaSection['icons'] as $icono){
                
                $id = $icono['id'];
                
                $icon = SpaIcon::query()->findOrNew($id);
                $icon->spa_section_id = $section->id;
                
                $spa_icon_name = '';
                foreach($icono['fieldTranslations'] as $iso){
                    if($iso['iso'] === 'en'){
                        foreach($iso['fields'] as $spaIconName){
                            if($spaIconName['field'] === 'name')
                            $spa_icon_name = $spaIconName['translation'];
                        }
                    }
                }

                $section_icons_icon = 'spaSectionicons_icon_'.$spa_icon_name.'_';

                if (isset($icono['icon'])) {
                    // Icon
                    $path = UploadImage::upload($icono['icon'], 'spa/icons/',$section_icons_icon);
                    
                    $icon->ico = $path;
                }
                $icon->save();
                $icon->updateFieldTranslations($icono['fieldTranslations']);
                $iconIds[] = $icon->id;
            }
            // Elimino todos los iconos que no llegaron de front
            SpaIcon::where('spa_section_id',$section->id)->whereNotIn('id', $iconIds)->delete();
        }
        
        // Elimino todas las secciones que no llegaron de front
        SpaSection::query()->whereNotIn('id', $sectionIds)->delete();

        $response = [
            'res' => 1,
            'msg' => 'Informacion de SPA actualizada',
            'data' => [
                compact('spaInfo')
            ]
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
        ];
    }
}