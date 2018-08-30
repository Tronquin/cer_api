<?php
namespace App\Handler;


use App\Service\ERPService;

class AvailabilityExperienceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $data = ERPService::availabilityExperience($this->params);

        $response['res'] = count($data);
        $response['msg'] = count($data).' Experiencias encontradas';
        $cantidadExperiencias = count($data)-1;
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
        $experiences = $this->orderExperiences($data, 'precio_upgrade',SORT_ASC);
        // ordenamos por precio de menor a mayor
        for ($count = 0;$count <= $cantidadExperiencias;$count++){
            $experiences[$count]['precio_upgrade_por_noche'] = $experiences[$count]['precio_upgrade']/$noches_alojamiento;

            if($experiences[$count]['extras'][$count]['manera_cobro'] == 'por_noche'){
                $experiences[$count]['por_noche'] = true;
                $experiences[$count]['por_persona'] = false;
            }elseif($experiences[$count]['extras'][$count]['manera_cobro'] == 'por_persona'){
                $experiences[$count]['por_noche'] = false;
                $experiences[$count]['por_persona'] = true;
            }elseif($experiences[$count]['extras'][$count]['manera_cobro'] == 'por_noche_por_persona'){
                $experiences[$count]['por_noche'] = true;
                $experiences[$count]['por_persona'] = true;
            }elseif($experiences[$count]['extras'][$count]['manera_cobro'] == 'por_estancia'){
                $experiences[$count]['por_noche'] = false;
                $experiences[$count]['por_persona'] = false;
            }

            if($count == $cantidadExperiencias){
                $experiences[$count]['recomendado'] = true;
            }else{
                $experiences[$count]['recomendado'] = false;
            }
        }

        $response['data'] = [
            'list' => $experiences,
        ];
        return $response;
    }

    function orderExperiences($array, $on, $order=SORT_ASC)
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