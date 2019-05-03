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
        $extras = [];
        foreach($locations as $location){
            foreach ($tagSearched->extras as $extraKey => $extra) {
                if ($location->ubicacion_id === $extra->ubicacion_id){
                    $extras[] = [
                        'id' => $extra->id,
                        'location_id' => $location->id,
                        'ubicacion_id' => $location->ubicacion_id,
                        'type' => $extra->type,
                        'precio' => $extra->calcularIva($extra->base_imponible,$extra->iva_tipo),
                        'fieldTranslations' => $extra->fieldTranslations(),
                        'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)])
                    ];
                }
            }
        }
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