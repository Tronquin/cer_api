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
     * @param $data
     * @return array
     */
    public static function findReservation($data)
    {
        $response = self::send('reservas/buscar_reservas', [
            'dato' => $data['numberCodeOrName'],
            'ubicacion_id' => $data['ubicacion_id'],
        ],1);

        return $response;
    }

    /**
     * Busca las reservas por id por post o get
     *
     * @param $data
     * @return array
     */
    public static function findReservationById($data)
    {
        if($data['method'] == 2){
            $data = self::send('reservas/get_reserva/'.$data['reserva_id'], [],$data['method']);
            $response['res'] = $data['res'];
            $response['msg'] = $data['msg'];
            $response['data'] = [
                'list' => $data['reserva'],
            ];
        }else{
            $data= self::send('reservas/buscar_reserva_por_id', [
                'reserva_id' => $data['reserva_id'],
            ],$data['method']);
            $response['res'] = 1;
            $response['msg'] = 'reserva encontrada';
            $response['data'] = [
                'list' => $data,
            ];
        }


        return $response;

    }

    /**
     * Busca los datos de las habitaciones disponibles para la reserva
     *
     * @param $data
     * @return array
     */
    public static function availabilityRoom($data)
    {
        $response = self::send('apartamentos/listar_disponibles/'.$data['reserva_id'], [],2);

        return $response;
    }

    /**
     * Busca los servicios de la reserva y las disponibles para comprar
     *
     * @param $data
     * @return array
     */
    public static function availabilityService($data)
    {
        $response = self::send('reservas/buscar_extras', [
            'reserva_id' => $data['reserva_id'],
            'funcion' => $data['funcion']
        ]);

        return $response;
    }

    /**
     * Busca la experiencia de una reserva y las disponibles para mejorar
     *
     * @param $data
     * @return array
     */
    public static function availabilityExperience($data)
    {
        $response = self::send('experiencias/listar/'.$data['reserva_id'], [],2);

        return $response;
    }

    /**
     * Busca el pax de la reserva
     *
     * @param $data
     * @return array
     */
    public static function availabilityPlan($data)
    {
        $response = self::send('regimenes/listar/'.$data['reserva_id'], [],2);

        return $response;
    }

    /**
     * Actualiza los servicios de la reserva seleccionada
     *
     * @param $data
     * @return array
     */
    public static function addReservationService($data)
    {
        $response = self::send('reservas/add_extras', [
            'reserva_id' => $data['reserva_id'],
            'pagado' => $data['pago_extras'],
            'extras' => $data['extras']
        ]);

        return $response;
    }

    /**
     * escaneo del pasaporte del huesped
     *
     * @param $data
     * @return array
     */
    public static function scanGuestPassport($data)
    {
        $file_encode = str_replace('+', '%2B', $data['file_encode']);
        $response = self::send('reservas/put_pasaporte', [
            'reserva_id' => $data['reserva_id'],
            'file_encode' => $file_encode,
        ]);

        return $response;
    }

    /**
     * actualiza los datos del huesped/pasaporte
     *
     * @param $data
     * @return array
     */
    public static function updateGuestPassport($data)
    {
        foreach ($data as $key => $huesped){
            $response = self::send('reservas/update_pasaporte', [
                'pasaporte_id' => $huesped['id'],
                'tipo_documento' => $huesped['tipo_documento'],
                'numero' => $huesped['numero'],
                'apellido1' => $huesped['apellido1'],
                'apellido2' => $huesped['apellido2'],
                'nombre' => $huesped['nombre'],
                'pais' => $huesped['pais'],
                'nacionalidad' => $huesped['nacionalidad'],
                'fecha_nacimiento' => $huesped['fecha_nacimiento'],
                'sexo' => $huesped['sexo'],
            ]);
        }

        return $response;
    }

    /**
     * Realiza los cambios en la reserva luego de procesar el pago
     *
     * @param $data
     * @return array
     */
    public static function reservationPayment($data)
    {
        $response = self::send('reservas/modificar_reserva', [
            'reserva_id' => $data['reserva_id'],
            'regimen_id' => $data['plan_id'],
            'apartamento_id' => $data['apartamento_id'],
            'experiencia_id' => $data['experience_id'],
            'pax_adultos' => $data['adults'],
            'pax_ninos' => $data['kids'],
            'pago_realizado' => $data['total'],
            'ha_seleccionado_apartamento' => $data['ha_seleccionado_apartamento'],
        ]);

        return $response;
    }

    /**
     * Busca los apartamentos de una ubicacion
     *
     * @param $id
     * @return array
     */
    public static function findApartment($id)
    {
        $response = self::send('reservas/', [
            'ubicacion_id' => $id,
        ]);

        return $response;
    }

    /**
     * Genera las tasas de una reserva
     *
     * @param $data
     * @return array
     */
    public static function generateRate($data)
    {
        $response = self::send('reservas/calcular_tasas', [
            'reserva_id' => $data['reserva_id'],
            'adultos' => $data['adults'],
            'ninos' => $data['kids'],
        ]);

        return $response;
    }

    /**
     * extras early and late checkin
     *
     * @param $data
     * @return array
     */
    public static function earlyAndLateCheckin($data)
    {
        $response = self::send('reservas/get_early_extra', [
            'reserva_id' => $data['reserva_id'],
        ]);

        return $response;
    }

    /**
     * consulta disponibilidad de un apartamento
     *
     * @param $data
     * @return array
     */
    public static function apartmentDisponibility($data)
    {
        $response = self::send('apartamentos/consultar_disponibilidad', [
            'reserva_id' => $data['reserva_id'],
            'apartamento_id' => $data['apartamento_id'],
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