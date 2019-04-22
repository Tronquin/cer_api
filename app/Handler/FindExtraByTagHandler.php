<?php

namespace App\Handler;

use App\Tag;

/**
 * Obtiene los extras para cada tag
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class FindExtraByTagHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $tagParents = Tag::query()
            ->with(['children.extras'])
            ->whereNull('parent_id')
            ->get();

        $response = [];
        foreach($tagParents as $tagParent){
            $childrens = [];
            foreach ($tagParent->children as $tag) {
                $extras = [];
                foreach ($tag->extras as $extra) {
                    $extras[] = [
                        'id' => $extra->id,
                        'type' => $extra->type,
                        'fieldTranslations' => $extra->fieldTranslations()
                    ];
                }

                $childrens[] =  [
                    'tagName' => $tag->description,
                    'tagId' => $tag->id,
                    'extras' => $extras
                ];
            }
            $response [] = [
                'tagParent' => $tagParent->description,
                'tagParentId' => $tagParent->id,
                'tagsChildrens' => $childrens,
            ];
        }

        return [
            'res' => count($response),
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
           
        ];
    }

}