<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Handler\FindExperienceHandler;
use App\Service\EmailService;
use App\Service\ERPService;
use App\Handler\AvailabilityServiceHandler;
use CTrans;

class SendNewExtraLandingErpHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = EmailService::sendHiredServiceErp($this->params);
        
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
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
            'reserva_id' => 'required|numeric'
        ];
    }

}