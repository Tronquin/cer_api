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

        if (isset($this->params['photo'])) {
            // Imagen
            $path = UploadImage::upload($this->params['photo'], 'spa/');

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

            if (isset($spaSection['photo'])) {
                // Imagen
                $path = UploadImage::upload($spaSection['photo'], 'spa/');

                $section->photo = $path;
            }

            if (isset($spaSection['ico'])) {
                // Icon
                $path = UploadImage::upload($spaSection['ico'], 'spa/');

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

                if (isset($icono['icon'])) {
                    // Icon
                    $path = UploadImage::upload($icono['icon'], 'spa/icons/');
    
                    $icon->ico = $path;
                }
                $icon->save();
                $icon->updateFieldTranslations($icono['fieldTranslations']);
                $iconIds[] = $icon->id;
            }
            // Elimino todos los iconos que no llegaron de front
            SpaIcon::query()->whereNotIn('id', $iconIds)->delete();
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