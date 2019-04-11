<?php
namespace App\Handler;

use App\Document;

class ListDocumentHandler extends BaseHandler
{
    public function handle()
    {
        $document = Document::query()->where('id', $this->params['id'])->get();
        
        return compact('document', 'id');
    }

    public function validationRules()
    {
        return [
            
        ];
    }
}
