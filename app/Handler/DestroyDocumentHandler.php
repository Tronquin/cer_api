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
        $extraOutstanding = ExtraOustanding::query()->where('id', '=', $this->params['id'])->get();

        Storage::delete($extraOutstanding->document);
    
        $extraOutstanding->document = "";
        $extraOutstanding->document_name = "";
        $extraOutstanding->save();
            
        return ['data' => ['deleted' => true]];
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
