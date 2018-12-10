<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use App\Photo;
use Illuminate\Support\Facades\Storage;

class CreatePhotoHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $galeria = new Photo();

        if (isset($this->params['data']['archivo'])) {
            // Imagen
            $path = $this->uploadImage($this->params['data']['archivo'], 'locations/' . $this->params['data']['ubicacion_id'] . '/');

            $galeria->archivo = $path;
        }
        $galeria->foto_id = 0;
        $galeria->type = 'web';
        $galeria->galleries_id = $this->params['data']['galeria_id'];
        $galeria->descripcion_es = isset($this->params['data']['nombre_fr']) ? $this->params['data']['nombre_fr'] : null;
        $galeria->descripcion_en = isset($this->params['data']['nombre_po']) ? $this->params['data']['nombre_po'] : null;
        $galeria->descripcion_fr = isset($this->params['data']['nombre_po']) ? $this->params['data']['nombre_po'] : null;
        $galeria->descripcion_zh = isset($this->params['data']['tipologia_id']) ? $this->params['data']['tipologia_id'] : null;
        $galeria->descripcion_ru = isset($this->params['data']['tipologia_id']) ? $this->params['data']['tipologia_id'] : null;
        $galeria->descripcion_po = isset($this->params['data']['tipologia_id']) ? $this->params['data']['tipologia_id'] : null;

        $galeria->save();

        $response['res'] = '1';
        $response['msg'] = 'foto guardada exitosamente';
        $response['data'] = $galeria;

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
            'nombre' => 'required',
            'ubicacion_id' => 'required|numeric',
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