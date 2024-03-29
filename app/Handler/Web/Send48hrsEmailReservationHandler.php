<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Handler\FindExperienceHandler;
use App\Service\EmailService;
use App\Service\ERPService;
use App\Handler\AvailabilityServiceHandler;
use CTrans;

class Send48hrsEmailReservationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $response = ERPService::completeInfo($this->params);
        $data['reserva'] = $response['data'];
        
        $handler = new FindExperienceHandler(['experiencia_id' => $data['reserva']['experiencia']['id']]);
        $handler->processHandler();
        $data['lang'] = $this->params['iso'];

        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => CTrans::trans('email.subject.48hs.errorExperience', $data['lang']),
            ];
        }
        $experiencia = $handler->getData();
        $data['reserva']['experiencia'] = $experiencia['data'];
        

        $fecha_entrada = explode(" ",$data['reserva']['fecha_entrada']);
        $fecha_salida = explode(" ",$data['reserva']['fecha_salida']);
        $data['reserva']['fecha_entrada'] = $fecha_entrada[0];
        $data['reserva']['fecha_salida'] = $fecha_salida[0];
        $data['reserva']['hora_entrada'] = $fecha_entrada[1];
        $data['reserva']['hora_salida'] = $fecha_salida[1];

        $handler = new AvailabilityServiceHandler(['reserva_id' => $data['reserva']['id'],'funcion' => 'checkin']);
        $handler->processHandler();

        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => CTrans::trans('email.subject.48hs.errorExp', $data['lang']),
            ];
        }
        $servicios = $handler->getData();
        $data['reserva']['extras_disponibles'] = $servicios['data']['list']['extras']['extras_disponibles'];

        EmailService::send('email.48hEmail', CTrans::trans('email.subject.48hs', $data['lang']),[$data['reserva']['cliente']['email']],['data' => $data]);

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
            'reserva_id' => 'required|numeric',
            'iso' => 'required'
        ];
    }

}