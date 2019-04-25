<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use App\Imagen;

class UploadImage
{
    /**
     * Carga una imagen a la carpeta publica
     *
     * @param string $base64
     * @param string $folder
     * @param $filename
     * @return string
     */
    public static function upload($base64, $folder, $filename = null)
    {
        $extension = self::getImageType($base64);
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);
        $name = '';
        if (! $filename) {
            $uniq = uniqid();
            $name = $uniq;
        }else{
            $filename = strtolower(str_replace(' ','_',$filename));
            $uniq = uniqid();
            $name = $filename;
        }
        $filename = $uniq . $extension;
        $path = $folder . $filename;
        Storage::disk('public')->put($path, $upload);
        $size = str_replace('/', '-', $path);

        $tamaño = getimagesize(env('APP_URL').'storage/image/size/'.$size);
        $name = $name.$tamaño[0].'x'.$tamaño[1].'-'.$uniq;
        
        $imagen = new Imagen();
        $imagen->slug = $name;
        $imagen->url = $path;
        $imagen->save();

        return $name;
    }

    /**
     * Extrae el tipo de imagen del base64
     *
     * @param string $base64
     * @return string
     * @throws \Exception
     */
    private static function getImageType($base64)
    {
        $base64 = explode(',', $base64);

        if (str_replace('image/png', '', $base64[0]) !== $base64[0]) {
            return '.png';
        }

        if (str_replace('image/jpg', '', $base64[0]) !== $base64[0]) {
            return '.jpg';
        }

        if (str_replace('image/jpeg', '', $base64[0]) !== $base64[0]) {
            return '.jpg';
        }

        if (str_replace('image/svg+xml', '', $base64[0]) !== $base64[0]) {
            return '.svg';
        }

        throw new \Exception('Image format invalid');
    }
}