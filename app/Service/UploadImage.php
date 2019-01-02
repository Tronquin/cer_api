<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;

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

        if (! $filename) {
            $filename = uniqid();
        }

        $filename = $filename . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
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