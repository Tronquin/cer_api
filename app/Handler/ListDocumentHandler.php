<?php
namespace App\Handler;

use App\Document;

class ListDocumentHandler extends BaseHandler
{
    public function handle()
    {
        return Document::latest()->paginate(10);
    }

    public function validationRules()
    {
        return [
            
        ];
    }
}
