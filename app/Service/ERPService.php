<?php
namespace App\Service;

class ERPService {

    /** Verbos en las peticiones */
    const METHOD_POST = 1;
    const METHOD_GET = 2;

    /**
     * Busca una reserva por numero o apellido
     *
     * @param $numberOrName
     * @return array
     */
    public static function findReservation($numberOrName)
    {
        $response = self::send('reservas/buscar_checkins', [
            'dato' => $numberOrName,
            'ubicacion_id' => 1,
            'fecha' => '2018-07-10'
        ]);

        return $response;
    }

    /**
     * Envia un request al ERP
     *
     * @param $url
     * @param array $params
     * @param $method
     * @return mixed
     *
     * @throws \Exception
     */
    private static function send($url, $params = [], $method = self::METHOD_POST)
    {
        $url = config('services.erp.base') . $url;
        $params['api_key'] = config('services.erp.api_key');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method === self::METHOD_POST) {

            $postFields = '';

            foreach ($params as $key => $value) {

                $postFields .= ($postFields !== '' ? '&' : '') . $key . '=' . $value;
            }

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);

        if (! $response) {
            // Si no retorna un Json dispara una exception
            throw new \Exception('Bad request to ERP');
        }

        return $response;
    }
}