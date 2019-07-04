<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Imagen;
use App\Service\UrlGenerator;

class FindImageHandler extends BaseHandler {

    protected $cache = true;

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $images = Imagen::query();

        if (isset($this->params['category'])) {
            $images->where('category', $this->params['category']);
        }

        if (isset($this->params['dimension'])) {
            $dimension = explode('x', $this->params['dimension']);
            $images->where('width', $dimension[0])->where('height', $dimension[1]);
        }

        $images = $images->get();

        foreach ($images as $image) {

            $slugOrUrl = $image->slug ? $image->slug : $image->url;

            $image->url = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $slugOrUrl)]);
        }

        return [
            'res' => count($images),
            'msg' => 'Imagenes',
            'data' => $images
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [];
    }

}