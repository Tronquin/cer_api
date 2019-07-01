<?php
namespace App\Handler;

use App\Language;
use App\Location;
use Request;

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
        $xml = new \SimpleXMLElement('<urlset></urlset>');
        $xml['xmlns'] = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $xml['xmlns:news'] = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml['xmlns:xhtml'] = 'http://www.w3.org/1999/xhtml';
        $xml['xmlns:mobile'] = 'http://www.google.com/schemas/sitemap-mobile/1.0';
        $xml['xmlns:image'] = 'http://www.google.com/schemas/sitemap-image/1.1';
        $xml['xmlns:video'] = 'http://www.google.com/schemas/sitemap-video/1.1';

        $domain = Request::root();
        $explode = explode('://', $domain);

        $locations = Location::orderBy('id')->where('domain', $explode[1])->get();
        if (! count($locations)) {
            $locations = Location::orderBy('id')->get();
        }

        $languages = Language::orderBy('main', 'DESC')->orderBy('id')->get();

        foreach ($languages as $language) {
            $base = $domain . '/' . $language->iso;

            $xml->addChild('url');
            $xml->url[ $xml->url->count() - 1 ]->loc = $base;
            $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';

            $xml->addChild('url');
            $xml->url[ $xml->url->count() - 1 ]->loc = $base . '/register';
            $xml->url[ $xml->url->count() - 1 ]->priority = '0.5';

            $xml->addChild('url');
            $xml->url[ $xml->url->count() - 1 ]->loc = $base . '/faq';
            $xml->url[ $xml->url->count() - 1 ]->priority = '0.7';

            foreach ($locations as $location) {

                $locationBase = $base . '/' . str_slug($location->nombre);

                $xml->addChild('url');
                $xml->url[ $xml->url->count() - 1 ]->loc = $locationBase;
                $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';

                $xml->addChild('url');
                $xml->url[ $xml->url->count() - 1 ]->loc = $locationBase . '/serviciosExclusivos';
                $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';

                $xml->addChild('url');
                $xml->url[ $xml->url->count() - 1 ]->loc = $locationBase . '/experiencia';
                $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';

                $xml->addChild('url');
                $xml->url[ $xml->url->count() - 1 ]->loc = $locationBase . '/extras';
                $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';

                if ($location->has_spa) {
                    $xml->addChild('url');
                    $xml->url[ $xml->url->count() - 1 ]->loc = $locationBase . '/spanGym';
                    $xml->url[ $xml->url->count() - 1 ]->priority = '1.0';
                }
            }
        }

        return compact('xml');
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