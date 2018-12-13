<?php
namespace App\Handler;
use App\Galery;

/**
 * Obtiene todas las imagenes de una galeria
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class GetPhotoByGallery extends BaseHandler
{

    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $gallery = Galery::where('code', $this->params['galleryCode'])->with(['photos'])->firstOrFail();

        $photos = $gallery->photos;

        foreach ($photos as $photo) {
            $photo->url = route('storage.image', ['image' => str_replace('/', '-', $photo->url)]);
        }

        if (count($photos) === 0) {
            $photos[] = [
                'url' => 'https://via.placeholder.com/150x150'
            ];
        }

        $response['res'] = count($photos);
        $response['msg'] = 'Fotos de la galeria ' . $gallery->code;
        $response['data'] = $photos;

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
            'galleryCode' => 'required'
        ];
    }
}