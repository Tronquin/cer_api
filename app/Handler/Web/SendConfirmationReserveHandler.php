<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Handler\FindExperienceHandler;
use App\Service\EmailService;
use App\Service\ERPService;
use App\Mail\BaseMail;
use App\Handler\AvailabilityServiceHandler;

class SendConfirmationReserveHandler extends BaseHandler
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
        $extras_price = 0;
        foreach($data['reserva']['experiencia']['extras'] as $extra){
            $extras_price = $extras_price + $extra['precio']['total'];
        }

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
        $data['reserva']['extras_contratados'] = $servicios['data']['list']['extras']['extras_contratados'];
        $total = 0;
        foreach($data['reserva']['extras_contratados'] as &$extra){
            $extra['precio']['total'] = round($extra['precio']['total']);
            $total = $total + $extra['precio']['total'];
        }
        $data['reserva']['total_extras_experiencia'] = $extras_price;
        $data['reserva']['total_extras_contratados'] = $total;
        $data['lang'] = $this->params['iso'];

        EmailService::send('email.confirmacionReserva',[$data['reserva']['cliente']['email']],['data' => $data]);
            
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