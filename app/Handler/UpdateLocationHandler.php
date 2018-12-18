<?php
namespace App\Handler;

use App\Location;
use App\Language;
use App\FieldTranslation;
use Illuminate\Support\Facades\Storage;

class UpdateLocationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $location = Location::where('ubicacion_id', $this->params['locationId'])->firstOrFail();
        $languages = Language::get(['iso','name']);

        if (isset($this->params['front_page'])) {
            // Imagen de portada
            $path = $this->uploadImage($this->params['front_page'], 'locations/' . $location->id . '/');

            $location->front_page = $path;
        }

        if (isset($this->params['logo'])) {
            // Logo
            $path = $this->uploadImage($this->params['logo'], 'locations/' . $location->id . '/');

            $location->logo = $path;
        }
        
        foreach($languages as $language){
            /*foreach($this->params['fieldTranslation'] as $field){
                
                if($field['iso'] == $languaje->iso){
                    $translation = FieldTranslation::where('content_id',$field['content_id'])
                            ->where('content_type',$field['content_type'])
                            ->where('field',$field['field'])
                            ->firstOrNew([]);

                            $translation->content_id = $field['content_id'];
                            $translation->incidencia_porcentaje = $field['content_type'];
                            $translation->descripcion_es = $language['id'];
                            $translation->descripcion_en = $key;
                            $translation->descripcion_fr = $field['translation'];

                            $translation->save();
                }
            }*/
        }

        $location->description = $this->params['description'];
        $location->save();

        $response = [
            'res' => 1,
            'msg' => 'Location actualizado',
            'data' => [
                compact('location')
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
            'locationId' => 'required|numeric',
            'description' => 'required',
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