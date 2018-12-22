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
        foreach($this->params['questions'] as $question){

            $id = $question['id'];

            $Question = FrequentQuestion::query()->findOrNew($id);
            $Question->order = isset($question['order']) ? $question['order'] : null;
            $Question->active = isset($question['active']) ? $question['order'] : 0;

            $data['fieldTranslations'] = $Question->fieldTranslations();
            
            $Question->save();
            $Question->updateFieldTranslations($question['fieldTranslations']);
            $Question['fieldTranslations'] = $Question->fieldTranslations();
            $data['questions'][] = $Question;
            $sectionIds[] = $Question->id;
        }

        // Elimino todas las secciones que no llegaron de front
        FrequentQuestion::query()->whereNotIn('id', $sectionIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
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