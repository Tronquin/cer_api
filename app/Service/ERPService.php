<?php
namespace App\Service;

class ERPService {

    /** Verbos en las peticiones */
    const METHOD_POST = 1;
    const METHOD_GET = 2;

    /**
     * Busca las reservas para checkin por ubicacion y fecha
     *
     * @param $data
     * @return array
     */
    public static function findReservationToCheckin($data)
    {
        $response = self::send('reservas/buscar_checkins', [
            'ubicacion_id' => $data['ubicacion_id'],
            'fecha' => $data['date']
        ]);

        return $response;
    }

    /**
     * Busca las reservas por numero,codigo o nombre
     *
     * @param $numberCodeOrName
     * @return array
     */
    public static function findReservation($numberCodeOrName)
    {
        $response = self::send('reservas/buscar_reservas', [
            'dato' => $numberCodeOrName,
            'ubicacion_id' => 1
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationRoom($data)
    {
        $response = self::send('reservas/change_room', [
            'reserva_id' => $data['reservation_id'],
            'pagado' => 1,
            'room' => $data['room_change']
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationService($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reservation_id'],
            'pagado' => 1,
            'services' => $data['service_change']
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationExperience($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reservation_id'],
            'pagado' => 1,
            'Experience' => $data['experience_change']
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationPack($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reservation_id'],
            'pagado' => 1,
            'Pack' => $data['pack_change']
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationKey($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reservation_id'],
            'pagado' => 1,
            'Key' => $data['Key_change']
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
            $firstPostArray = '';
            $secondPostArray = '';
            $ii = 0;
            $i = 0;

            foreach ($params as $key => $value) {

                $postFields .= ($postFields !== '' ? '&' : '') . (is_array($value) ? '' : $key . '=' . $value);
                if(is_array($value)){

                    $firstPostArrayName = $key;
                    foreach ($value as $firstArrayName => $firstArrayValue){
                        $firstPostArray = ($firstPostArray !== '' ? '&' : '') . (is_array($firstArrayValue) ? '' : $firstPostArrayName.'[' . $firstArrayName . ']=' . $firstArrayValue);
                        if(!is_array($firstArrayValue)){$postFields .= $firstPostArray ;}

                        if(is_array($firstArrayValue)){

                            $secondPostArrayName = $firstArrayName;
                            foreach ($firstArrayValue as $secondArrayName => $secondArrayValue){
                                $secondPostArray = ($secondPostArray !== '' ? '&' : '') . (is_array($secondArrayValue) ? '' : $firstPostArrayName . '['.$i.']' . '[' . $secondArrayName . ']=' . $secondArrayValue);
                                if(!is_array($secondArrayValue)){$postFields .= $secondPostArray ;}
                                $ii++;
                            }
                        }
                        $i++;
                    }
                }

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