<?php
namespace App\Handler;
use App\Galery;
use App\Location;
use App\Service\UrlGenerator;

/**
 * Obtiene todas las imagenes de todas las galerias por ubicacion
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class GetPhotoByGalleryByLocation extends BaseHandler
{

    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $location = Location::where('id', $this->params['location_id'])->firstOrFail();
        $galleries = Galery::where('location_id', $location->id)->with(['photos'])->get();

        foreach ($galleries as $gallery) {

            foreach ($gallery->photos as $photo) {
                $photo->url = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $photo->url)]);
                $photo->fieldTranslations = $photo->fieldTranslations();
            }

            if (count($gallery->photos) === 0) {
                $gallery->photos[] = [
                    'url' => 'https://via.placeholder.com/150x150',
                    'type' => '',
                    'fieldTranslations' => []
                ];
            }
        }

        $response['res'] = count($galleries);
        $response['msg'] = 'Fotos de la ubicacion ' . $location->name;
        $response['data'] = $galleries;

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
            'ubicacionId' => 'required'
        ];
    }
}