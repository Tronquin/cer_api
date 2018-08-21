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
            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }
        $tipos = $this->orderRoom($data, 'precio_upgrade',SORT_ASC);
        // ordenamos por precio de menor a mayor
        for ($count = 0;$count <= $tipologias;$count++){
            $tipos[$count]['precio_upgrade_por_noche'] = $tipos[$count]['precio_upgrade']/$noches_alojamiento;
            if($count == $tipologias){
                $tipos[$count]['recomendado'] = true;
            }else{
                $tipos[$count]['recomendado'] = false;
            }
        }

        $response['data'] = [
            'list' => $tipos,
        ];
        return $response;
    }

    function orderRoom($array, $on, $order=SORT_ASC)
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

        ];
    }

}