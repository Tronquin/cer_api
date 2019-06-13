<?php
namespace App\Handler\Web;

/* use App\Reservation; */
use App\Handler\BaseHandler;
use App\Handler\FindExperienceHandler;
use App\Service\EmailService;
use App\Service\ERPService;
use App\Handler\AvailabilityServiceHandler;
use CTrans;

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
        $data['lang'] = $this->params['iso'];
        
        $handler = new FindExperienceHandler(['experiencia_id' => $data['reserva']['experiencia']['id']]);
        $handler->processHandler();

        if (!$handler->isSuccess()) {
            return $response = [
                'res' => 0,
                'msg' => CTrans::trans('email.subject.48hs.errorExperience', $data['lang']),
            ];
        }
        $experiencia = $handler->getData();
        $data['reserva']['experiencia'] = $experiencia['data'];
        $extras_price = 0;
        foreach($data['reserva']['experiencia']['extras'] as &$extra){
            $extras_price = $extras_price + $extra['precio']['total'];
            $extra['precio']['total'] = round($extra['precio']['total']);
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
                'msg' => CTrans::trans('email.subject.48hs.errorExp', $data['lang']),
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
        $data['base_url'] = env('APP_URL');
        $data['web_url'] = env('WEB_URL_BASE').'es/checkin/ListReserve/'.$data['reserva']['id'];

        EmailService::send('email.confirmacionReserva', CTrans::trans('email.subject.confirmacionReserva', $data['lang']),[$data['reserva']['cliente']['email']],['data' => $data]);
            
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