<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Extra;
use App\Tag;
use App\Location;
use App\Service\UploadImage;

class SaveExtrasHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $location = Location::where('ubicacion_id',$this->params['data']['ubicacion_id'])->firstOrFail();
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
        $extra->is_published = $this->params['data']['is_published'];
        $extra_Name = '';
        foreach($this->params['data']['fieldTranslations'] as $iso){
            if($iso['iso'] === 'en'){
                foreach($iso['fields'] as $extraName){
                    if($extraName['field'] === 'nombre')
                    $extra_Name = $extraName['translation'];
                }
            }
        }
        $front_image_name = $location->pais.'_'.$location->ciudad.'_extra_img_'.$extra_Name.'_';
        $icon = $location->pais.'_'.$location->ciudad.'_extra_icon_'.$extra_Name.'_';

        if (isset($this->params['data']['front_image'])) {
            // Imagen
            $path = UploadImage::upload($this->params['data']['front_image'], 'extras/' . $extra->id . '/',$front_image_name);

            $extra->front_image = $path;
        }

        if (isset($this->params['data']['icon'])) {
            // Icono
            $path = UploadImage::upload($this->params['data']['icon'], 'extras/' . $extra->id . '/',$icon);

            $extra->icon = $path;
        }
        
        $response = $extra->save();

        $idTags = [];
        foreach ($this->params['data']['tags'] as $tagsParents){
            foreach ($tagsParents['data'] as $tags){
                $idTags[] = Tag::where('description', $tags['text'])->where('parent_id',$tagsParents['tagParentId'])->first()->toArray();
            }
        }
        $ids = [];
        if(isset($idTags)){
            foreach($idTags as $key => $tag) {
                $ids[] = $tag['id'];
            }
        }
        $extra_erp->tags()->detach($ids);
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