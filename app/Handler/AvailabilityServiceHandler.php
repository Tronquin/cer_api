<?php
namespace App\Handler;


use App\Service\ERPService;
use App\ReservationServicePersistence;

class AvailabilityServiceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $dataService = [
            'reserva_id' => $this->params['reserva_id'],
            'funcion' => $this->params['funcion'],
        ];
        $response = ERPService::availabilityService($dataService);
        $serviciosContratados['extras_disponibles'] = [];

        $service_persistence = ReservationServicePersistence::where('reserva_id', '=', $this->params['reserva_id'])->get();

            foreach ($response['data']['list']['extras_contratados'] as $key => $services) {
                $services['cantidad'] = 0;
                if(count($service_persistence) > 0){
                    foreach ($service_persistence as $key => $pservices){
                        if ($pservices['extra_id'] == $services['id']){
                            $services['cantidad'] = $pservices['cantidad'];
                        }
                    }
                }
                array_push($serviciosContratados['extras_disponibles'],$services);
            }
            foreach ($response['data']['list']['extras_disponibles'] as $key => $services) {
                $services['cantidad'] = 0;
                if(count($service_persistence) > 0){
                    foreach ($service_persistence as $key => $pservices){
                        if ($pservices['extra_id'] == $services['id']){
                            $services['cantidad'] = $pservices['cantidad'];
                        }
                    }
                }
                array_push($serviciosContratados['extras_disponibles'],$services);
            }

        $response = [
            'res' => $response['res'],
            'msg' => 'extras disponibles',
            'data' => [
                'list' => $serviciosContratados,
            ]
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
            'reserva_id' =>'required|numeric',
            'funcion' =>'required',
        ];
    }

}