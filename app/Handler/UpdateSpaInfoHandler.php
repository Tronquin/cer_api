<?php
namespace App\Handler;

use App\SpaInfo;
use App\SpaSection;
use Illuminate\Support\Facades\DB;
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

        $spaInfo->description = '';
        $spaInfo->photo = '';

        if (isset($this->params['photo'])) {
            // Imagen
            $path = $this->uploadImage($this->params['photo'], 'spa/');

            $spaInfo->photo = $path;
        }
        
        $spaInfo->save();
        $spaInfo->updateFieldTranslations($this->params['fieldTranslations']);
        
        $sectionIds = [];
        foreach ($this->params['spaSections'] as $spaSection) {

            $id = $spaInfo['id'] ?? 0;

            $section = SpaSection::query()->findOrNew($id);
            $section->spa_info_id = $spaInfo->id;
            $section->name = $spaSection['name'];

            $section->description = '';
            $section->ico = '';
            $section->photo = '';

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
            
            $section->updateFieldTranslations($this->params['fieldTranslations']);
            $sectionIds[] = $section->id;
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
            'spaSections' => 'required'
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