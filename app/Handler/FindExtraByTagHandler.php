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
            ->whereNull('parent_id')
            ->get();
        $response = [];
        foreach($tagParents as $tagParent){
            $response [] = $tagParent;
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