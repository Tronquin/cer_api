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
        $tagParent = Tag::query()
            ->with(['children.extras'])
            ->whereNull('parent_id')
            ->where('description', strtoupper($this->params['tag']))
            ->firstOrFail()
        ;

        $response = [];
        foreach ($tagParent->children as $tag) {
            $extras = [];
            foreach ($tag->extras as $extra) {
                $extras[] = [
                    'type' => $extra->type,
                    'fieldTranslations' => $extra->fieldTranslations()
                ];
            }

            $response[] = [
                'tag' => $tag->description,
                'extras' => $extras
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
           'tag' => 'required'
        ];
    }

}