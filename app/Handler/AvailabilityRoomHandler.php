<?php
namespace App\Handler;


use App\Service\ERPService;

class AvailabilityRoomHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $data = ERPService::availabilityRoom($this->params);

        $response['res'] = count($data);
        $response['msg'] = count($data).' Tipologias encontradas';
        $tipologias = count($data)-1;
        $handler = new FindReservationByIdHandler(['reserva_id' => $this->params['reserva_id'],'method' => 2]);
        $handler->processHandler();
        if ($handler->isSuccess()) {
            $noches_alojamiento = $handler->getData();
            $noches_alojamiento = $noches_alojamiento['data']['list']['noches_alojamiento'];

        }else{
            $response['res'] = 0;
            $response['msg'] = $handler->getStatusCode();
            $response['data'] = $handler->getErrors();
            return $response;
        }
        // ordenamos por precio de menor a mayor
        $tipos = $this->order($data, 'precio_upgrade',SORT_ASC);

        for ($count = 0;$count <= $tipologias;$count++){
            $tipos[$count]['precio_upgrade_por_noche'] = $tipos[$count]['precio_upgrade']/$noches_alojamiento;
            if($count == $tipologias){
                $tipos[$count]['recomendado'] = true;
            }else{
                $tipos[$count]['recomendado'] = false;
            }
        }

        $todosLosApartamentos = [];
        $pisos = 0;
        $plantaBaja = 0;

        foreach ($tipos as $key => $value){
            $apartamentoTipologia[$key] = $value['apartamentos'];
            foreach ($value['apartamentos'] as $aptkey => $apartamento){

                array_push($todosLosApartamentos,$apartamento);

                if ($apartamento['planta'] > $pisos){
                    $pisos = $apartamento['planta'];
                }
                if ($apartamento['planta'] = $plantaBaja){
                    $plantaBaja = 1;
                }
            }
        }
        // Ordenamos los apartamentos por piso
        $ordenadosPorPiso = $this->order($todosLosApartamentos, 'planta',SORT_ASC);
        $pisos = $pisos + $plantaBaja;
        $ordenados = [];
        for ($i = 0 ; $i <= $pisos; $i++){
            /*foreach ($ordenadosPorPiso as $key => $value){
                if($value['planta'] == $i && $value['puerta'] == $i) array_push($ordenados,$value);
            }*/
        }

        $response['data'] = [
            'list' => $tipos,
            //'pisos' => $pisos,
            //'orden' => $ordenadosPorPiso,
        ];
        return $response;
    }

    function order($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[] = $array[$k];
            }
        }

        return $new_array;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'reserva_id' =>'required|numeric',
        ];
    }

}