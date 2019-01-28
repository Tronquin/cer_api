<?php
namespace App\Handler;
use App\ERPImage;
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
            $photo->type = $photo->type ?? '';
            $photo->fieldTranslations = $photo->fieldTranslations();
        }

        if (count($photos) === 0) {
            $photos[] = [
                'url' => 'https://via.placeholder.com/150x150',
                'type' => ''
            ];
        }

        $erpImages = ERPImage::all();
        foreach ($erpImages as $erpImage) {
            $erpImage->completeUrl = route('storage.image', ['image' => str_replace('/', '-', $erpImage->url)]);
            $erpImage->fieldTranslations = $erpImage->fieldTranslations();
        }

        $response['res'] = count($photos);
        $response['msg'] = 'Fotos de la galeria ' . $gallery->code;
        $response['data'] = [
            'photos' => $photos,
            'erpImages' => $erpImages
        ];

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