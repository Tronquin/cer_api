<?php
namespace App\Handler\Web;

use App\Galery;
use App\Handler\BaseHandler;
use App\Photo;
use Illuminate\Support\Facades\Storage;

class CreatePhotoHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $gallery = Galery::where('code', $this->params['data']['galleryCode'])->firstOrFail();

        $response['data'] = [];
        foreach ($this->params['data']['photos'] as $p) {

            $path = $this->uploadImage($p['photo'], 'galleries/' . $gallery->id . '/');

            $photo = new Photo();
            $photo->gallery_id = $gallery->id;
            $photo->url = $path;
            $photo->save();

            $response['data'][] = $photo;
        }

        $response['res'] = '1';
        $response['msg'] = 'foto guardada exitosamente';

        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'galleryCode' => 'required',
            'photos' => 'required'
        ];
    }

    /**
     * Carga una imagen
     *
     * @param string $base64
     * @param string $folder
     * @return string
     */
    private function uploadImage($base64, $folder)
    {
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);
        $extension = str_replace('image/png', '', $base64[0]) !== $base64[0] ? '.png' : '.jpg';
        $filename = uniqid() . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
    }

}