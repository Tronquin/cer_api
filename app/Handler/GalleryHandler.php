<?php
namespace App\Handler;


use App\Service\ERPService;

class GalleryHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::getGallery($this->params);

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
            'galleryId' =>'required',
        ];
    }

}