<?php
namespace App\Service;

class ERPService {

    /** Verbos en las peticiones */
    const METHOD_POST = 1;
    const METHOD_GET = 2;

    /**
     * adjunta imagen del pasaporte
     *
     * @param $data
     * @return array
     */
    public static function addPassaport($data)
    {
        $response = self::send('reservas/put_pasaporte', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * escaneo del pasaporte
     *
     * @param $data
     * @return array
     */
    public static function scanPassaport($data)
    {
        $response = self::send('reservas/put_pasaporte', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

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
     * Busca las reservas para checkin por ubicacion y fecha
     *
     * @param $id
     * @return array
     */
    public static function reservationCheckin($id)
    {
        $response = self::send('reservas/realizar_checkin', [
            'reserva_id' => $id,
        ]);

        return $response;
    }

    /**
     * Busca las reservas por localizador o apellido
     *
     * @param $numberCodeOrName
     * @return array
     */
    public static function findReservation($numberCodeOrName)
    {

        $response = self::send('reservas/buscar_reservas', [
            'dato' => $numberCodeOrName['numberCodeOrName'],
            'ubicacion_id' => 1
        ],1);

        return $response;
    }

    /**
     * Busca las reservas por id
     *
     * @param $numberCodeOrName
     * @return array
     */
    public static function findReservationById($reserva_id)
    {

        $response = self::send('reservas/get_reserva/'.$reserva_id, [],2);

        return $response;

    }

    /**
     * Busca la habitacion de la reserva y las disponibles para mejorar
     *
     * @param $data
     * @return array
     */
    public static function availabilityRoom($data)
    {
        $response = self::send('reservas/buscar_habitaciones', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * Actualiza la habitacion de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationRoom($data)
    {
        $response = self::send('reservas/change_room', [
            'reserva_id' => $data['reserva_id'],
            'room' => $data['room_change']
        ]);

        return $response;
    }

    /**
     * Busca los servicios de la reserva y las disponibles para comprar
     *
     * @param $data
     * @return array
     */
    public static function findReservationService($data)
    {
        $response = self::send('reservas/buscar_extras', [
            'reserva_id' => $data['reserva_id'],
            'funcion' => $data['funcion']
        ]);

        return $response;
    }

    /**
     * Actualiza los servicios de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationService($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reserva_id'],
            'pagado' => 0,
            'extras' => $data['service_change']
        ]);

        return $response;
    }

    /**
     * Busca la experiencia de una reserva y las disponibles para mejorar
     *
     * @param $data
     * @return array
     */
    public static function findReservationExperience($data)
    {
        $response = self::send('reservas/buscar_experience', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * Actualiza la experiencia de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationExperience($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reserva_id'],
            'pagado' => 1,
            'Experience' => $data['experience_change']
        ]);

        return $response;
    }

    /**
     * Busca el pax de la reserva
     *
     * @param $data
     * @return array
     */
    public static function findReservationPax($data)
    {
        $response = self::send('reservas/buscar_pax', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * Actualiza el pax de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationPax($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reserva_id'],
            'pagado' => 1,
            'Pax' => $data['pax_change']
        ]);

        return $response;
    }

    /**
     * Busca las llaves de la reserva
     *
     * @param $data
     * @return array
     */
    public static function findReservationKey($data)
    {
        $response = self::send('reservas/buscar_key', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * Busca y actualiza la cantidad de llaves de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function changeReservationKey($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reserva_id'],
            'pagado' => 1,
            'Key' => $data['Key_change']
        ]);

        return $response;
    }

    /**
     * Guarda los datos de huespedes en la reserva
     *
     * @param $data
     * @return array
     */
    public static function saveReservationGuest($data)
    {
        $response = self::send('reservas/', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * Busca los datos de huespedes en la reserva
     *
     * @param $data
     * @return array
     */
    public static function findReservationGuest($data)
    {
        $response = self::send('reservas/', [
            'reserva_id' => $data['reserva_id'],
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
        }elseif ($method === self::METHOD_GET){
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
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