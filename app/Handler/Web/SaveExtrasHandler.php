<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Extra;
use App\Tag;
use App\Service\UploadImage;

class SaveExtrasHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $extra_erp = Extra::where('extra_id','=',$this->params['data']['extra_id'])->with('tags')->where('type','=','erp')->first();
        $extra = Extra::where('extra_id','=',$this->params['data']['extra_id'])->with('tags')->where('type','=','web')->first();

        if(! $extra){
            $extra = new Extra();
        }

        $extra->extra_id = $this->params['data']['extra_id'];
        $extra->type = 'web';
        $extra->parent_id = $extra_erp->id;
        $extra->ubicacion_id = $this->params['data']['ubicacion_id'];
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
            $path = UploadImage::upload($this->params['data']['front_image'], 'extras/' . $extra->id . '/');

            $extra->front_image = $path;
        }

        if (isset($this->params['data']['icon'])) {
            // Icono
            $path = UploadImage::upload($this->params['data']['icon'], 'extras/' . $extra->id . '/');

            $extra->icon = $path;
        }
        
        $response = $extra->save();

        $arrayTags = [];
        foreach ($this->params['data']['tags'] as $tagsParents){
            foreach ($tagsParents as $tags){
                $idTags[] = Tag::where('description', $tags['text'])->first()->toArray();
            }
        }
        $ids = [];
        if(isset($idTags)){
            foreach($idTags as $key => $tag) {
                $ids[] = $tag['id'];
            }
        }
        $extra->tags()->sync($ids);
        
        $extra->updateFieldTranslations($this->params['data']['fieldTranslations']);
       
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
            "destacado" => 'required|numeric',
            "activo" => 'required|numeric',
        ];
    }
}