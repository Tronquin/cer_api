<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\FrequentQuestion;
use Illuminate\Support\Facades\Storage;

class UpdateOrCreateFrequentQuestionHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $questionsIds = [];
        foreach($this->params['questions'] as $question){

            $id = $question['id'];
            $idLocations = [];
            $is_main_web=false;
            $Question = FrequentQuestion::query()->findOrNew($id);
            $Question->order = isset($question['order']) ? $question['order'] : null;
            $Question->active = isset($question['active']) ? $question['active'] : 0;
            if (isset($question['tags'])) {
                if (count($question['tags'])>0) {
                    foreach ($question['tags'] as $tags) {
                        if ($tags['castro']) {
                            $Question->main_web = true;
                            $is_main_web=true;
                        }else{
                            $idLocations[] = $tags['id'];
                        }
                    }
                } else {
                    $Question->main_web = false;
                }   
                $Question->locations()->sync($idLocations);
                if (!$is_main_web) {
                    $Question->main_web = false;
                }
            }           

            $data['fieldTranslations'] = $Question->fieldTranslations();
            
            $Question->save();
            $Question->updateFieldTranslations($question['fieldTranslations']);
            $Question['fieldTranslations'] = $Question->fieldTranslations();
            $data['questions'][] = $Question;
            $questionsIds[] = $Question->id;
        }

        // Elimino todas las secciones que no llegaron de front
        FrequentQuestion::query()->whereNotIn('id', $questionsIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
            'id'=>$id,
        ];

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
            
        ];
    }

}