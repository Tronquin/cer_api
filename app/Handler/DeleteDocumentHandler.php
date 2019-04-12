<?php
namespace App\Handler;

use App\Document;

class DeleteDocumentHandler extends BaseHandler
{
    public function handle()
    {
        if (Document::where('id', '=', $this->params['id'])->delete()) {
            return ['data' => ['deleted' => true]];
        }

        return ['data' => ['deleted' => false]];
    }

    public function validationRules()
    {
        return[
            'id' => 'required'
        ];
    }
}
