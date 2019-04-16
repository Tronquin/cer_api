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
        $extraOutstanding = ExtraOustanding::where('id', '=', $this->params['id'])->get();

        if (isset($this->params['document']) && isset($this->params['document_name'])) {
            $extraOutstanding->document = "";
            $extraOutstanding->document_name = "";
            $extraOutstanding->save();
            Storage::delete($this->params['document']);
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
