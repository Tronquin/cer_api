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