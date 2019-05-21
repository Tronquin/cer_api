<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Handler\FindExperienceHandler;
use App\Service\EmailService;
use App\Service\ERPService;
use App\Mail\BaseMail;
use Illuminate\Support\Facades\Mail;
use App\Handler\AvailabilityServiceHandler;

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

        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => 'error para obtener la experiencia',
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
                'msg' => 'error para obtener los extras contratados',
            ];
        }
        $servicios = $handler->getData();
        $data['reserva']['extras_disponibles'] = $servicios['data']['list']['extras']['extras_disponibles'];
        
        $data['lang'] = $this->params['iso'];

        EmailService::send('email.48hEmail',[$data['reserva']['cliente']['email']],['data' => $data]);

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