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
        $response['data'] = [
            'list' => $data,
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