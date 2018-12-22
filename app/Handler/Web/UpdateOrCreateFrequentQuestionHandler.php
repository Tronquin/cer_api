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
        if(isset($this->params['id'])){
            $frequentQuestions = FrequentQuestion::where('id',$this->params['id'])->first();
            $frequentQuestions->order = isset($this->params['order']) ? $this->params['order'] : null;
            $frequentQuestions->active = isset($this->params['active']) ? $this->params['order'] : 0;
        }else{
            $frequentQuestions = new FrequentQuestion();
            $frequentQuestions->order = isset($this->params['order']) ? $this->params['order'] : null;
            $frequentQuestions->active = isset($this->params['active']) ? $this->params['order'] : 0;
            $frequentQuestions->save();
        }
        if (isset($this->params['fieldTranslations'])){
            $frequentQuestions->updateFieldTranslations($this->params['fieldTranslations']);
        }
        $frequentQuestions->save();

        $frequentQuestions['fieldTranslations'] = $frequentQuestions->fieldTranslations();

        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $frequentQuestions,
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