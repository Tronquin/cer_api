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
                $extras = [];
                foreach ($tag->extras as $extraKey => $extra) {
                    
                    if($extra->ubicacion_id === intval($this->params['ubicacion_id'])){
                        $extras[] = [
                            'id' => $extra->id,
                            'type' => $extra->type,
                            'coste' => $extra->coste,
                            'fieldTranslations' => $extra->fieldTranslations(),
                            'front_image' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extra->front_image)])
                        ];
                    }
                }
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