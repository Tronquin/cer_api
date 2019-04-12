<?php
namespace App\Handler;

use App\Document;

class ListDocumentHandler extends BaseHandler
{
    public function handle()
    {
        $documents = Document::query()->orderBy('id', 'DESC')->get();
        return [
            'res' => count($documents),
            'data' => $documents
        ];
    }

    public function validationRules()
    {
        return [
            
        ];
    }
}
