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

        foreach ($tipos as $key => $value){
            $apartamentoTipologia[$key] = $value['apartamentos'];
            foreach ($value['apartamentos'] as $aptkey => $apartamento){
                // juntamos todos los apartamentos en un array
                array_push($todosLosApartamentos,$apartamento);

                if ($apartamento['planta'] > $pisos){
                    //obtenemos los pisos principales
                    $pisos = $apartamento['planta'];
                }
            }
        }

        // Ordenamos por piso
        $ordenadosPorPiso = $this->order($todosLosApartamentos, 'planta',SORT_ASC);
        //recorremos los pisos para asignar los apartamentos
        for ($i = 0 ; $i <= $pisos; $i++){
            $ordenados[$i] = [];
            foreach ($ordenadosPorPiso as $key => $value){
                if($i == $value['planta']){
                    array_push($ordenados[$i],$value);
                  //Ordenamos los Apartamentos de cada piso
                    $ordenados[$i] = $this->order($ordenados[$i], 'puerta',SORT_ASC);
                }
            }
        }

        $response['data'] = [
            'list' => $tipos,
            'pisos' => $ordenados,
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