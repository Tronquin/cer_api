<?php
namespace App\Handler\GeneralHandlers;

use App\Extra;
use App\Tag;
use App\Location;
use App\Handler\BaseHandler;

class SaveMasiveExtraTagsHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $extraTagIds = [];
        if($this->params['method'] === 'save'){
            foreach ($this->params['extras'] as $extra){
                $extra = Extra::where('extra_id','=',$extra)->where('type','erp')->with('tags','child')->first();
                $extraWebOrErp = $extra->child ? $extra->child : $extra;
                
                foreach($extraWebOrErp->tags as $tag){
                    $extraTagIds[] = $tag->id;
                }
                foreach ($this->params['tags'] as $tagsParents){
                    foreach ($tagsParents['selected'] as $tag){
                        $extraTagIds[] = $tag;
                    }
                }

                array_unique($extraTagIds);
                $extra->tags()->detach($extraTagIds);
                $extraWebOrErp->tags()->sync($extraTagIds);
            }
        }else if($this->params['method'] === 'eliminar'){
            foreach ($this->params['extras'] as $extra){
                $extra = Extra::where('extra_id','=',$extra)->where('type','erp')->with('tags','child')->first();
                $extraWebOrErp = $extra->child ? $extra->child : $extra;

                foreach($extraWebOrErp->tags as $tag){
                    $extraTagIds[] = $tag->id;
                }
                foreach ($this->params['tags'] as $tagsParents){
                    foreach ($tagsParents['selected'] as $tag){
                        foreach ($extraTagIds as $key => $tagId){
                            if($tagId === $tag)
                            unset($extraTagIds[$key]);
                        }
                    }
                }
                array_unique($extraTagIds);
                $extra->tags()->detach($extraTagIds);
                $extraWebOrErp->tags()->sync($extraTagIds);
            }
        }
       
        return [
            'res' => 1,
            'msg' => 'tags agregados correctamente',
            'data' => count($this->params['extras'])
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
            'extras' => 'required',
            'tags' => 'required'
        ];
    }

}