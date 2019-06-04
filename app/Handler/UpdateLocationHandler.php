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

        $front_image_name = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_img_'.$this->params['nombre'].'_');
        $icon = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_icon_'.$this->params['nombre'].'_');
        $domainLogo = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_domain_logo_'.$this->params['nombre'].'_');
        $marker = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_marker_'.$this->params['nombre'].'_');
        $favicon = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_favicon_'.$this->params['nombre'].'_');
        $register_img = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_registerImg_'.$this->params['nombre'].'_');
        $header_exp_domain = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_headerExpDomain_'.$this->params['nombre'].'_');
        $header_exp = UploadImage::slug($location->pais.'_'.$location->ciudad.'_location_headerExp_'.$this->params['nombre'].'_');

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

        if (isset($this->params['marker'])) {
            // marker
            $path = UploadImage::upload($this->params['marker'], 'locations/' . $location->id . '/',$marker);

            $location->marker = $path;
        }

        if (isset($this->params['favicon'])) {
            // marker
            $path = UploadImage::upload($this->params['favicon'], 'locations/' . $location->id . '/',$favicon);

            $location->favicon = $path;
        }

        if (isset($this->params['register_img'])) {
            // marker
            $path = UploadImage::upload($this->params['register_img'], 'locations/' . $location->id . '/',$register_img);

            $location->register_img = $path;
        }

        if (isset($this->params['header_exp_domain'])) {
            // header exp domain
            $path = UploadImage::upload($this->params['header_exp_domain'], 'locations/' . $location->id . '/',$header_exp_domain);

            $location->header_exp_domain = $path;
        }

        if (isset($this->params['header_exp'])) {
            // header exp
            $path = UploadImage::upload($this->params['header_exp'], 'locations/' . $location->id . '/',$header_exp);

            $location->header_exp = $path;
        }

        $domain = str_replace('http://', '', $this->params['domain']);
        $domain = str_replace('https://', '', $domain);
        $location->domain = $domain;
        $location->has_spa = $this->params['has_spa'];
        $location->is_published = $this->params['is_published'];
        $location->link_tour = $this->params['link_tour'];
        $location->alt_marker = $this->params['alt_marker'];
        $location->alt_favicon = $this->params['alt_favicon'];
        $location->facebook = $this->params['facebook'];
        $location->alt_register_img = $this->params['alt_register_img'];
        $location->instagram = $this->params['instagram'];
        $location->email_contact = $this->params['email_contact'];
        $location->phone_contact = $this->params['phone_contact'];

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