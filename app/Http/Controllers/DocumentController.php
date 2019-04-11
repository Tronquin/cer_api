<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\StoreDocumentHandler;
use App\Handler\DeleteDocumentHandler;
use App\Handler\ListDocumentHandler;

/**
 * This Controller Will be Refactor after testing
 * @author Francisco Bejarano
 */

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $handler = new ListDocumentHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    public function destroy(Request $request)
    {
        $data = $request->all();

        $handler = new DeleteDocumentHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $handler = new StoreDocumentHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
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
