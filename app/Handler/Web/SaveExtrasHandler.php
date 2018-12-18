<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Extra;
use Illuminate\Support\Facades\Storage;

class SaveExtrasHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $extra_erp = Extra::where('extra_id','=',$this->params['data']['extra_id'])->where('type','=','erp')->first();
        $extra = Extra::where('extra_id','=',$this->params['data']['extra_id'])->where('type','=','web')->first();

        if(! $extra){
            $extra = new Extra();
        }

        $extra->extra_id = $this->params['data']['extra_id'];
        $extra->type = 'web';
        $extra->parent_id = $extra_erp->id;
        $extra->ubicacion_id = $this->params['data']['ubicacion_id'];
        $extra->nombre = $this->params['data']['nombre'];
        $extra->nombre_es = $this->params['data']['nombre_es'];
        $extra->nombre_en = $this->params['data']['nombre_en'];
        $extra->nombre_fr = $this->params['data']['nombre_fr'];
        $extra->nombre_zh = $this->params['data']['nombre_zh'];
        $extra->nombre_ru = $this->params['data']['nombre_ru'];
        $extra->nombre_po = $this->params['data']['nombre_po'];
        $extra->descripcion_es = $this->params['data']['descripcion_es'];
        $extra->descripcion_en = $this->params['data']['descripcion_en'];
        $extra->descripcion_fr = $this->params['data']['descripcion_fr'];
        $extra->descripcion_zh = $this->params['data']['descripcion_zh'];
        $extra->descripcion_ru = $this->params['data']['descripcion_ru'];
        $extra->descripcion_po = $this->params['data']['descripcion_po'];
        $extra->coste = $this->params['data']['coste'];
        $extra->base_imponible = $this->params['data']['base_imponible'];
        $extra->iva_tipo = $this->params['data']['iva_tipo'];
        $extra->manera_cobro = $this->params['data']['manera_cobro'];
        $extra->servicio_gestion = $this->params['data']['servicio_gestion'];
        $extra->destacado = $this->params['data']['destacado'];
        $extra->activo = $this->params['data']['activo'];
        $extra->outstanding = $this->params['data']['outstanding'];

        if (isset($this->params['data']['front_image'])) {
            // Imagen
            $path = $this->uploadImage($this->params['data']['front_image'], 'extras/' . $extra->id . '/');

            $extra->front_image = $path;
        }

        if (isset($this->params['data']['icon'])) {
            // Icono
            $path = $this->uploadImage($this->params['data']['icon'], 'extras/' . $extra->id . '/');

            $extra->icon = $path;
        }

        //$extra->updateFieldTranslations($this->params['data']['fieldTranslations']);

        $response = $extra->save();
       
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
            'extra_id' => 'required|numeric',
            'ubicacion_id' => 'required|numeric',
            'nombre' => 'required',
            "destacado" => 'required|numeric',
            "activo" => 'required|numeric',
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