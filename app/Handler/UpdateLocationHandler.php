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

        $front_image_name = $location->pais.'_'.$location->ciudad.'_location_img_'.$this->params['nombre'].'_';
        $icon = $location->pais.'_'.$location->ciudad.'_location_icon_'.$this->params['nombre'].'_';
        $domainLogo = $location->pais.'_'.$location->ciudad.'_location_domain_logo_'.$this->params['nombre'].'_';


        if (isset($this->params['front_page'])) {
            // Imagen de portada
            $path = UploadImage::upload($this->params['front_page'], 'locations/' . $location->id . '/',$front_image_name);

            $location->front_page = $path;
        }

        if (isset($this->params['logo'])) {
            // Logo
            $path = UploadImage::upload($this->params['logo'], 'locations/' . $location->id . '/',$icon);

            $location->logo = $path;
        }

        if (isset($this->params['domain_logo'])) {
            // Logo
            $path = UploadImage::upload($this->params['domain_logo'], 'locations/' . $location->id . '/',$domainLogo);

            $location->domain_logo = $path;
        }

        $domain = str_replace('http://', '', $this->params['domain']);
        $domain = str_replace('https://', '', $domain);
        $location->domain = $domain;
        $location->has_spa = $this->params['has_spa'];
        $location->has_spa = $this->params['is_published'];
        $location->link_tour = $this->params['link_tour'];
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
            'fieldTranslations' => 'required',
        ];
    }
}