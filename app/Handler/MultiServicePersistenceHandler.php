<?php
namespace App\Handler;

use App\Reservation;
use App\ReservationServicePersistence;
use App\Service\EmailService;
use App\Service\ERPService;

class MultiServicePersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $extras = [];
        $pagos = [];

        foreach($this->params['data']['apartments'] as &$apartamento){
            $extras_add = [];
            foreach($apartamento['extrasCustomStay'] as &$extra){
                $extra['id'] = $extra['extra_id'];
            }
            $extras_add['pago_extras'] = 0;
            $extras_add['reserva_id'] = $apartamento['reserva_id_erp'];
            $extras_add['extras'] = $apartamento['extrasCustomStay'];

            $response = ERPService::addReservationService($extras_add);
            
            foreach ($extras_add['extras'] as $extra) {
    
                $service_persistence = new ReservationServicePersistence();
    
                $service_persistence->reserva_id = $extras_add['reserva_id'];
                $service_persistence->extra_id = $extra['id'];
                $service_persistence->cantidad = $extra['cantidad'];
                $service_persistence->status_id = 2;
    
                $service_persistence->save();
            }
            $extras[] = $response['data']['extras'];
            $pagos[] = $response['data']['pago'];

            $reservation = Reservation::query()->where('reserva_id_erp', $this->params['data']['reserva_id'])->first();
            EmailService::sendHiredService($reservation);
        }
        
        return $extras = [
            'res' => 1,
            'msg' => 'extras agregados correctamente',
            'data' => [
                'extras' => $extras,
                'pagos' => $pagos
            ]
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            //'extras' =>'required',
        ];
    }

}