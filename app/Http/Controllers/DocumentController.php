<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\StoreDocumentHandler;
use App\Handler\DestroyDocumentHandler;
use App\Service\UploadDocument;
use Illuminate\Support\Facades\File;
use App\Document;
use App\Location;
use App\ExtraOustanding;
use Illuminate\Support\Facades\DB;

/**
 * This Controller Will be Refactor after testing
 * @author Francisco Bejarano
 */

class DocumentController extends Controller
{
    public function index()
    {
        return Document::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $response = [];

        DB::beginTransaction();

        $uploadedFile = $request->file('document');
        $filename = time().$uploadedFile->getClientOriginalName();
        $document = new Document();
        $document->name = $filename;
        $document->url = 'document/'.$filename;
        $document->extension = $request->file('document')->extension();
        $document->Locations()->associate(Location::class);
        $document->extraOutstandings()->associate(ExtraOustanding::class);
        $document->save();

        DB::commit();

        $response['data'] = $document;

        return $response;
    }

    public function upload(Request $request)
    {
        $response = [];

        $uploadedFile = $request->file('document');
        $filename = time().$uploadedFile->getClientOriginalName();
        $this->validate($request, [
            'url' => 'required',
            'name' => 'required',
            'extension' => 'required'
        ]);

        $response['data'] = $uploadedFile;

        UploadDocument::upload($uploadedFile, 'document/', $filename);

        return $response;
    }
    
    public function getDocument($document)
    {
        $path = str_replace('-', '/', $document);
        $path = storage_path('app/public') . '/' . $path;

        if (! file_exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);
    }
}
