<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Ruta para acceder a las imagenes en el storage
     *
     * @param string $image
     * @return Response
     */
    public function getImage($image)
    {
        $path = str_replace('-', '/', $image);
        $path = storage_path('app/public') . '/' . $path;

        if (! file_exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;

    }
}