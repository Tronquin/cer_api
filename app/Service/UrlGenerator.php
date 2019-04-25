<?php
namespace App\Service;

/**
 * Servicio para generar url con un root domain especifico
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class UrlGenerator {

    /**
     * Genera la url
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    public static function generate($name, array $params = [])
    {
        $base = config('app.url');
        $route = route($name, $params, false);

        while ($base[ strlen($base) - 1 ] === '/') {
            $base = substr($base, 0, -1);
        }

        return urldecode($base . $route);
    }
}