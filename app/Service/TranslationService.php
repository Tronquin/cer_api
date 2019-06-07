<?php
namespace App\Service;

/**
 * Llama a los servicios de traduccion
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class TranslationService {

    const METHOD_POST = 1;
    const METHOD_GET = 2;

    /**
     * Traduce un texto desde la API
     *
     * @param string $text
     * @param string $isoFrom
     * @param string $isoTo
     * @return array
     */
    public static function trans(string $text, string $isoFrom, string $isoTo)
    {
        return self::send(
            'https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => 'trnsl.1.1.20190122T181209Z.b03cc69ca79ebfaf.c214bffe6085613809d5bb2d384f42ffe905cf09',
                'lang' => "{$isoFrom}-{$isoTo}",
                'text' => str_replace(';', 'punto_y_coma', $text)
            ]
        );
    }



    /**
     * Llama a la API
     *
     * @param string $url
     * @param array $params
     * @param int $method
     * @return array
     * @throws \Exception
     */
    private static function send($url, $params = [], $method = self::METHOD_POST)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($method === self::METHOD_POST) {

            $postFields = '';
            foreach ($params as $key => $value) {
                $postFields .= ($postFields !== '' ? '&' : '') . (is_array($value) ? '' : $key . '=' . $value);
            }

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        }elseif ($method === self::METHOD_GET){
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        }

        $response = curl_exec($ch);
        curl_close($ch);
        $response = str_replace('punto_y_coma', ';', $response);
        $response = json_decode($response, true);

        if (! $response) {
            // Si no retorna un Json dispara una exception
            throw new \Exception('Bad request to API');
        }

        return $response;
    }
}