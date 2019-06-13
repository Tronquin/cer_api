<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Service\UrlGenerator;
use App\Tag;
use App\Location;
use App\Handler\BaseHandler;

class FindExtraByLocationTagChildrenHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $tagParent = Tag::query()
            ->where('description',strtoupper($this->params['type']))
            ->first();
        $tagSearched = Tag::query()->where('parent_id',$tagParent->id)
            ->where('description',strtoupper($this->params['tag_children']))
            ->with('extras')
            ->first();

        $locations = Location::all();
        $response = [];

        $extrasERP = [];
        $extrasWEB = [];

        foreach($locations as $location){
            foreach ($tagSearched->extras as $extraKey => $extra) {
                if ($location->ubicacion_id === $extra->ubicacion_id){
                    if($extra->type === 'erp' && $extra->is_published){
                        $extrasERP[] = [
                            'id' => $extra->id,
                            'extra_id' => $extra->extra_id,
                            'location_id' => $location->id,
                            'manera_cobro' => $extra->manera_cobro,
                            'ubicacion_id' => $location->ubicacion_id,
                            'type' => $extra->type,
                            'precio' => $extra->calcularIva($extra->base_imponible,$extra->iva_tipo),
                            'fieldTranslations' => $extra->fieldTranslations(),
                            'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)]),
                            'front_image_large' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image_large)])
                        ];
                    }else if($extra->type === 'web' && $extra->is_published){
                        $extrasWEB[] = [
                            'id' => $extra->id,
                            'extra_id' => $extra->extra_id,
                            'location_id' => $location->id,
                            'manera_cobro' => $extra->manera_cobro,
                            'ubicacion_id' => $location->ubicacion_id,
                            'type' => $extra->type,
                            'precio' => $extra->calcularIva($extra->base_imponible,$extra->iva_tipo),
                            'fieldTranslations' => $extra->fieldTranslations(),
                            'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)]),
                            'front_image_large' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image_large)])
                        ];
                    }
                }
            }
        }
        foreach($extrasERP as $erpKey => $eErp){
            foreach($extrasWEB as $eWeb){
                if($eErp['extra_id'] === $eWeb['extra_id']){
                    unset($extrasERP[$erpKey]);
                }
            }
        }
        $extras = array_merge($extrasERP,$extrasWEB);
        
        $response = [
            'tag' => $tagSearched->description,
            'extras' => $extras,
        ];
       
        return [
            'res' => count($extras),
            'msg' => 'tag '.$this->params['tag_children'].' type '.$this->params['type'],
            'data' => $response
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'tag_children' => 'required',
            'type' => 'required'
        ];
    }

}