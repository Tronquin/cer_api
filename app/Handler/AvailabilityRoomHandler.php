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

        $count = 0;
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
        // ordenamos por precio de menor a mayor
        for ($tipologias;$tipologias >= 0;$tipologias--){
            $tipos[$count] = $data[$tipologias];
            $tipos[$count]['precio_upgrade_por_noche'] = $data[$tipologias]['precio_upgrade']/$noches_alojamiento;
            $count ++;
        }
        $response['data'] = [
            'list' => $tipos,
        ];
        return $response;
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