<?php
namespace App\Handler;

use App\SpaInfo;
use App\SpaSection;
use Illuminate\Support\Facades\Storage;

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
            $path = $this->uploadImage($this->params['photo'], 'spa/');

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
                $path = $this->uploadImage($spaSection['photo'], 'spa/');

                $section->photo = $path;
            }

            if (isset($spaSection['ico'])) {
                // Icon
                $path = $this->uploadImage($spaSection['ico'], 'spa/');

                $section->ico = $path;
            }

            $section->save();
            
            $section->updateFieldTranslations($spaSection['fieldTranslations']);
            $sectionIds[] = $section->id;

            $iconIds = [];
            foreach($this->params['spaSections']['icons'] as $icon){

                $id = $icon['id'];

                $icon = Icon::query()->findOrNew($id);
                $icon->section_id = $section->id;

                if (isset($icon['ico'])) {
                    // Icon
                    $path = $this->uploadImage($icon['ico'], 'spa/icons/');
    
                    $section->ico = $path;
                }
                $icon->save();
            
                $icon->updateFieldTranslations($icon['fieldTranslations']);
                $iconIds[] = $icon->id;
            }
            // Elimino todos los iconos que no llegaron de front
            Icon::query()->whereNotIn('id', $iconIds)->delete();
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

    /**
     * Carga una imagen
     *
     * @param string $base64
     * @param string $folder
     * @return string
     */
    private function uploadImage($base64, $folder)
    {
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);
        $extension = str_replace('image/png', '', $base64[0]) !== $base64[0] ? '.png' : '.jpg';
        $filename = uniqid() . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
    }
}