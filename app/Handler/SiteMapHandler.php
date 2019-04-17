<?php
namespace App\Handler;

use App\Language;
use App\Location;

/**
 * Obtiene la informacion necesario para armar
 * el sitemap
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class SiteMapHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $locations = Location::orderBy('id')->get();
        $languages = Language::all();

        foreach ($locations as $location) {
            $location->slug = str_slug($location->nombre);
        }

        return compact('locations', 'languages');
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