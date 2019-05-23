<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Service\UrlGenerator;
use App\Tag;
use App\Location;
use App\Handler\BaseHandler;

class FindExtraByLocationTagHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $tagParents = Tag::query()
            ->with(['children.extras'])
            ->where('description',strtoupper($this->params['type']))
            ->get();
        
        $response = [];
        foreach($tagParents as $parentKey => $tagParent){
            $childrens = [];
            foreach ($tagParent->children as $tagKey => $tag) {
                $extrasERP = [];
                $extrasWEB = [];
                foreach ($tag->extras as $extraKey => $extra) {
                    
                    if($extra->ubicacion_id === intval($this->params['ubicacion_id'])){
                        $precio = $extra->calcularIva($extra->base_imponible,$extra->iva_tipo);
                        if($extra->type === 'erp'){
                            $extrasERP[] = [
                                'id' => $extra->id,
                                'manera_cobro' => $extra->manera_cobro,
                                'extra_id' => $extra->extra_id,
                                'type' => $extra->type,
                                'precio' => $precio,
                                'coste' => $precio['total'],
                                'fieldTranslations' => $extra->fieldTranslations(),
                                'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)])
                            ];
                        }else if($extra->type === 'web'){
                            $extrasWEB[] = [
                                'id' => $extra->id,
                                'manera_cobro' => $extra->manera_cobro,
                                'extra_id' => $extra->extra_id,
                                'type' => $extra->type,
                                'precio' => $precio,
                                'coste' => $precio['total'],
                                'fieldTranslations' => $extra->fieldTranslations(),
                                'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)])
                            ];
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

                $childrens [] = [
                    'tag' => $tag->description,
                    'extras' => $extras,
                ];
            }
            $response = [
                'tagParent' => $tagParent->description,
                'tagsChildrens' => $childrens,
            ];
        }
       
        return [
            'res' => 1,
            'msg' => 'tag '.$this->params['type'],
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
            'ubicacion_id' => 'required|numeric',
            'type' => 'required'
        ];
    }

}