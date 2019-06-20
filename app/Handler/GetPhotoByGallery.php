<?php
namespace App\Handler;
use App\ERPImage;
use App\Galery;
use App\Service\UrlGenerator;

/**
 * Obtiene todas las imagenes de una galeria
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class GetPhotoByGallery extends BaseHandler
{

    protected $cache = true;

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
            $photo->url = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $photo->url)]);
            $photo->type = $photo->type ?? '';
        }

        if (count($photos) === 0) {
            $photos[] = [
                'url' => 'https://via.placeholder.com/150x150',
                'type' => '',
                'fieldTranslations' => []
            ];
        }

        $erpImages = [];
        if (! isset($this->params['erp_images']) || $this->params['erp_images']) {

            $erpImages = ERPImage::all();
            foreach ($erpImages as $erpImage) {
                $erpImage->completeUrl = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $erpImage->url)]);
            }
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
            'galleryCode' => 'required',
        ];
    }
}