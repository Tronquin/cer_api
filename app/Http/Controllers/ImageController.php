<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Imagen;

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

        $imagen = Imagen::where('slug', $image)->first();

        if (!$imagen) {
            $imagen = [];
            $imagen['url'] = str_replace('/', '-', $image);
        }

        $imageRelativePath = str_replace('-', '/', $imagen['url']);
        $publicPath = storage_path('app/public') . '/' . $imageRelativePath;
        $optimizedPath = storage_path('app/optimized') . '/' . $imageRelativePath;

        $webpPath = storage_path('app/webp') . '/' . $imageRelativePath;
        $explode = explode('/', $webpPath);
        $nameAndFormat = explode('.', last($explode));
        $webpPath = str_replace(".{$nameAndFormat[1]}", '.webp', $webpPath);

        if (file_exists($webpPath)) {
            $path = $webpPath;
        } elseif (file_exists($optimizedPath)) {
            $path = $optimizedPath;
        } else {
            $path = $publicPath;
        }

        if (!file_exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        if ($type === 'text/html' || $type === 'image/svg') {
            $type = 'image/svg+xml';
        }

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    /**
     * Ruta para obtener descripcion de una imagen en el storage
     *
     * @param string $image
     * @return Response
     */
    public function getImageSize($image)
    {
        $imageRelativePath = str_replace('-', '/', $image);
        $publicPath = storage_path('app/public') . '/' . $imageRelativePath;
        $optimizedPath = storage_path('app/optimized') . '/' . $imageRelativePath;


        if (file_exists($optimizedPath)) {
            $path = $optimizedPath;
        } else {
            $path = $publicPath;
        }

        if (!file_exists($publicPath)) {
            abort(404);
        }


        $file = File::get($path);
        $type = File::mimeType($path);

        if ($type === 'text/html') {
            $type = 'image/svg+xml';
        }

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}
