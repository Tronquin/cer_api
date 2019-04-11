<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;

class UploadDocument
{
    /**
     * Carga un documento a la carpeta publica
     *
     * @param string $base64
     * @param string $folder
     * @param $filename
     * @return string
     */
    public static function upload($base64, $folder, $filename = null)
    {
        $extension = self::getDocumentType($base64);
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);

        if (! $filename) {
            $filename = uniqid();
        }

        $filename = 'document-upload-' . time() . '.' . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
    }

    /**
     * Extrae el tipo de documento del base64
     *
     * @param string $base64
     * @return string
     * @throws \Exception
     */
    private static function getDocumentType($base64)
    {
        $base64 = explode(',', $base64);

        if (str_replace('document/pdf', '', $base64[0]) !== $base64[0]) {
            return '.pdf';
        }

        if (str_replace('document/docx', '', $base64[0]) !== $base64[0]) {
            return '.docx';
        }

        if (str_replace('document/doc', '', $base64[0]) !== $base64[0]) {
            return '.doc';
        }

        throw new \Exception('Document format invalid');
    }
}
