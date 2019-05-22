<?php
namespace App\Handler;


use App\Extra;
use App\Service\EmailService;
use App\Service\ERPService;

class ReservationPaymentHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = ERPService::reservationPayment($this->params['data']);

        if ($response['res'] > 0) {

            foreach ($response['data']['modificaciones'] as $mod) {
                if ($mod > 0) {

                    $reservation = $response['data']['reserva'];
                    $recipients = [$reservation['cliente']['email']];
                    $checkin = explode(' ', $reservation['fecha_entrada']);
                    $checkout = explode(' ', $reservation['fecha_salida']);

                    $handler = new AvailabilityServiceHandler([
                        'reserva_id' => $reservation['id'],
                        'funcion' => 'checkin'
                    ]);
                    $handler->processHandler();
                    $serviceData = $handler->getData();

                    $services = [];
                    foreach ($serviceData['data']['list']['extras']['extras_contratados'] as $extra) {
                        $extraInstance = Extra::find($extra['id']);
                        $extraName = '';
                        foreach ($extraInstance->fieldTranslations() as $fieldTranslation) {
                            if ($fieldTranslation['iso'] === 'es') {
                                foreach ($fieldTranslation['fields'] as $field) {
                                    if ($field['field'] === 'nombre') {
                                        $extraName = $field['translation'];
                                        break(2);
                                    }
                                }
                            }
                        }
                        $services[] = [
                            'name' => $extraName,
                            'amount' => $extra['precio']['total']
                        ];
                    }

                    $data = [
                        'data' => [
                            'modificaciones' => $response['data']['modificaciones'],
                            'checkin' => $checkin[0],
                            'checkinHour' => $checkin[1],
                            'checkout' => $checkout[0],
                            'checkoutHour' => $checkout[1],
                            'locator' => $reservation['localizador'],
                            'name' => $reservation['cliente']['nombre'] . ' ' . $reservation['cliente']['apellido'],
                            'pax' => $reservation['adultos'] . ' adultos - ' . $reservation['ninos'] . ' niños',
                            'apartment' => $reservation['ubicacion']['nombre'],
                            'apartmentType' => $reservation['tipologia']['nombre'],
                            'package' => $reservation['tarifa']['nombre'],
                            'experience' => $reservation['experiencia']['nombre'],
                            'experienceAmount' => '',
                            'cancellationPolicy' => $reservation['politica_cancelacion']['nombre_cliente'],
                            'address' => $reservation['ubicacion']['direccion'],
                            'services' => $services,
                            'total' => ''
                        ]
                    ];

                    EmailService::send('email.reservationUpdated', 'Modificación de reserva', $recipients, $data);

                    break;
                }
            }
        }

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
            'plan_id' =>'required|numeric',
            'experience_id' =>'required|numeric',
            'kids' =>'required|numeric',
            'adults' =>'required|numeric',
            'total' =>'required|numeric',
            'ha_seleccionado_apartamento' => 'required|numeric',
        ];
    }

}