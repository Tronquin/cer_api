<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationByKeyHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        
        $response = ERPService::getReservationByKey($this->params);

        $response = [
            'res' => 1,
            'msg' => 'Reserva encontrada',
            'data' => [
                'list' => $response,
            ],
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
            'key' =>'required',
        ];
    }

}