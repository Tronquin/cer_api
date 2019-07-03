<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Imagen;
use Browser;

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

        $canUseWebp = file_exists($webpPath);
        if($canUseWebp){
            if(Browser::isChrome()){
                if(Browser::browserVersionMajor()<9){
                    $canUseWebp = false;
                }
            }else if(Browser::isSafari() || Browser::isIE()){
                $canUseWebp = false;
            }else if(Browser::isFirefox()){
                if(Browser::browserVersionMajor()<65){
                    $canUseWebp = false;
                }
            }else if(Browser::isOpera()){
                if(Browser::browserVersionMajor()<11){
                    $canUseWebp = false;
                }
            }else if(strrpos(Browser::platformFamily(),'Edge')===0){
                if(Browser::browserVersionMajor()<18){
                    $canUseWebp = false;
                }
            }else if (Browser::platformFamily()==='Android'){
                if(Browser::platformVersionMajor()<4){
                    $canUseWebp = false;
                }
            }else if (strrpos(Browser::platformFamily(),'Kai')===0){
                $canUseWebp = false;
            }else if (strrpos(Browser::platformFamily(),'Blackberry')===0){
                $canUseWebp = false;
            }
        }
        if($canUseWebp){
            $path = $webpPath;
        }else if (file_exists($optimizedPath)) {
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
