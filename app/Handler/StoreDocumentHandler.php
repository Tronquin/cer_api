<?php
namespace App\Handler;

use App\Document;
use App\ExtraOustanding;
use App\Location;
use App\Service\UploadDocument;
use App\Extra;

class StoreDocumentHandler extends BaseHandler
{
    public function handle($data)
    {
        //New Document Model Instance
        $model = new Document();
        //new Location Model Instance + Query for Correct Location of Document
        $location = Location::query()->where('ubicacion_id', $this->params['location_id'])->firstOrFail();
        //new extra outstanding instance + Query for correct Extra Outstanding of document
        $extraOutstanding = ExtraOustanding::query()->where('id', $this->params['extra_outstandings_id']);

        //Table Data Gathering
        $document = $data->file('document');
        $name = 'document-upload-' . time() . '.' . $document->getClientOriginalExtension();
        $description = $document->description();
        $url = $document->storeAs('document', $name);
        $extension = $document->getClientOriginalExtension();
        $documentLocation = $location->id;
        $documentExtraOutstanding = $extraOutstanding->id;

        //Database Save

        $document->url = $url;
        $document->description = $description;
        $document->name = $name;
        $document->extension = $extension;
        $document->location_id = $documentLocation;
        $document->extra_outstandings_id = $documentExtraOutstanding;
        $document->save();

        //Saves file to Storage Folder
        UploadDocument::upload($document, $url, $name);

        return [
            'res' => 1,
            'msg' => 'Informacion de Documento',
            'data' => [
                compact('document')
            ]
        ];
    }

    public function validationRules()
    {
        return [
            'url' => 'require',
            'description' => 'require',
            'name' => 'require',
            'extension' => 'require'
        ];
    }
}
