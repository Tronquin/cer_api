<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Handler\StoreDocumentHandler;
use App\Handler\DeleteDocumentHandler;
use App\Handler\ListDocumentHandler;
use Psy\Util\Json;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

/**
 * This Controller Will be Refactor after testing
 * @author Francisco Bejarano
 */

class DocumentController extends Controller
{
    public function getDocument($document)
    {
        //Gets Aproppiate Storage Document Path
        $path = str_replace('-', '/', $document);
        $path = storage_path('app/public') . '/' . $path;

        //If Path(Document) Doesn't exist, throw 404 error
        if (! file_exists($path)) {
            abort(404);
        }
        
        //Get Document and File type
        $file = File::get($path);
        $type = File::mimeType($path);

        //Make a response and add a custom header to it
        $file = convert_from_latin1_to_utf8_recursively($file);
        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return new JsonResponse($response);
    }
    
    /**
     * Encode array from latin1 to utf8 recursively
     * @param $dat
     * @return array|string
     */
    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) {
                $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);
            }
 
            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) {
                $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);
            }
 
            return $dat;
        } else {
            return $dat;
        }
    }
    // public function index(Request $request)
    // {
    //     $data = $request->all();
    //     $handler = new ListDocumentHandler($data);
    //     $handler->processHandler();

    //     if ($handler->isSuccess()) {
    //         return new JsonResponse($handler->getData());
    //     }

    //     return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    // }

    // public function destroy(Request $request)
    // {
    //     $data = $request->all();

    //     $handler = new DeleteDocumentHandler($data);
    //     $handler->processHandler();

    //     if ($handler->isSuccess()) {
    //         return new JsonResponse($handler->getData());
    //     }

    //     return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->all();

    //     $handler = new StoreDocumentHandler($data);
    //     $handler->processHandler();

    //     if ($handler->isSuccess()) {
    //         return new JsonResponse($handler->getData());
    //     }

    //     return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    // }
}
