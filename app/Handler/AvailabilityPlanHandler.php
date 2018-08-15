<?php
namespace App\Handler;


use App\Service\ERPService;

class AvailabilityPlanHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $data = ERPService::availabilityPlan($this->params);

        $response['res'] = count($data);
        $response['msg'] = count($data).' Planes encontrados';
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