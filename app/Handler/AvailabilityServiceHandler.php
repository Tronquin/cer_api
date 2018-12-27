<?php
namespace App\Handler;


use App\Service\ERPService;
use App\ReservationServicePersistence;
use App\Extra;

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
        $extras = [];
        $extrasContratados = [];
        $serviciosContratados['extras'] = $response['data']['list'];

        $service_persistence = ReservationServicePersistence::where('reserva_id', '=', $this->params['reserva_id'])->where('status_id','=',1)->get();

            foreach ($response['data']['list']['extras_contratados'] as $key => $services) {
                $services['cantidad'] = 0;
                $services['per_pax'] = stripos($services['manera_cobro'], "por_persona") !== false;
                $services['per_night'] = stripos($services['manera_cobro'], "por_noche") !== false;
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
                $services['per_pax'] = stripos($services['manera_cobro'], "por_persona") !== false;
                $services['per_night'] = stripos($services['manera_cobro'], "por_noche") !== false;
                if(count($service_persistence) > 0){
                    foreach ($service_persistence as $key => $pservices){
                        if ($pservices['extra_id'] == $services['id']){
                            $services['cantidad'] = $pservices['cantidad'];
                        }
                    }
                }
                array_push($serviciosContratados['extras_disponibles'],$services);
            }
        // Ordenamos con los destacados == 1 de primero
        $serviciosContratados['extras_disponibles'] = $this->order($serviciosContratados['extras_disponibles'], 'destacado',SORT_DESC);
        
        // Aqui buscamos los extras en cer-api para la respuesta usada en la web
        foreach ($serviciosContratados['extras']['extras_contratados'] as $extcERP){
            $contratados = Extra::where('extra_id',$extcERP['id'])
                                    ->where('type','erp')
                                    ->with(['child'])
                                    ->get();
                foreach ($contratados as $contratado) {
                    $webOrErp = $contratado->child ? $contratado->child->toArray() : $contratado->toArray();
                    $webOrErp['fieldTranslations'] = $contratado->child ? $contratado->child->fieldTranslations() : $contratado->fieldTranslations();
                    $webOrErp['icon'] = route('storage.image', ['image' => str_replace('/', '-', $webOrErp['icon'])]);
                    $webOrErp['front_image'] = route('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_image'])]);
        
                    $extrasContratados[] = $webOrErp;
                }
        }
        foreach ($serviciosContratados['extras_disponibles'] as $extrasERP){
            $serviciosContratados['extras']['extras_disponibles'] = Extra::where('extra_id',$extrasERP['id'])
                                                                            ->where('type','erp')
                                                                            ->with(['child'])
                                                                            ->get();
                foreach ($serviciosContratados['extras']['extras_disponibles'] as $extErp) {
                    $webOrErp = $extErp->child ? $extErp->child->toArray() : $extErp->toArray();
                    $webOrErp['fieldTranslations'] = $extErp->child ? $extErp->child->fieldTranslations() : $extErp->fieldTranslations();
                    $webOrErp['icon'] = route('storage.image', ['image' => str_replace('/', '-', $webOrErp['icon'])]);
                    $webOrErp['front_image'] = route('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_image'])]);
        
                    $extras[] = $webOrErp;
                }
        }
        $serviciosContratados['extras']['extras_disponibles'] = $extras;
        $serviciosContratados['extras']['extras_contratados'] = $extrasContratados;
        // Fin asisgnacion web

        $response = [
            'res' => $response['res'],
            'msg' => 'extras disponibles',
            'data' => [
                'list' => $serviciosContratados,
            ]
        ];

        return $response;
    }

    function order($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[] = $array[$k];
            }
        }

        return $new_array;
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