<?php
namespace App\Handler;

use App\ExtraOustanding;
use Illuminate\Support\Facades\Storage;

class DestroyDocumentHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        if (ExtraOustanding::where('id', '=', $this->params['id'])->delete()) {
            if (isset($this->params['document'])) {
                Storage::delete($this->params['document']);
            }
            return ['data' => ['deleted' => true]];
        }

        return ['data' => ['deleted' => false]];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'id' =>'required',
        ];
    }
}
