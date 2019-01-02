<?php
namespace App\Handler;

use App\Location;
use App\Service\UploadImage;

class UpdateLocationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $location = Location::where('ubicacion_id', $this->params['locationId'])->firstOrFail();

        if (isset($this->params['front_page'])) {
            // Imagen de portada
            $path = UploadImage::upload($this->params['front_page'], 'locations/' . $location->id . '/');

            $location->front_page = $path;
        }

        if (isset($this->params['logo'])) {
            // Logo
            $path = UploadImage::upload($this->params['logo'], 'locations/' . $location->id . '/');

            $location->logo = $path;
        }
        
        $location->updateFieldTranslations($this->params['fieldTranslations']);

        $location->save();

        $response = [
            'res' => 1,
            'msg' => 'Location actualizado',
            'data' => [
                compact('location')
            ]
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
            'locationId' => 'required|numeric',
            'fieldTranslations' => 'required'
        ];
    }
}