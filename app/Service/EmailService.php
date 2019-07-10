<?php
namespace App\Service;

use App\EmailSpooler;
use App\Extra;
use App\Handler\AvailabilityServiceHandler;
use App\Reservation;
use CTrans;

/**
 * Servicio para envio de correos. Actualmente el servicio
 * registra los correos en una cola. El comando SendEmailCommand
 * deberia estar configurado cada minuto
 *
 * Configurado en:
 * @see \App\Console\Kernel
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class EmailService
{
    /**
     * Envia un correo a cola
     *
     * @param string $view
     * @param string $subject
     * @param array $recipients
     * @param array $params
     */
    public static function send($view, $subject, array $recipients, array $params = [])
    {
        $emailSpooler = new EmailSpooler();
        $emailSpooler->view = $view;
        $emailSpooler->subject = $subject;
        $emailSpooler->recipients = json_encode($recipients);
        $emailSpooler->params = json_encode($params);
        $emailSpooler->status = EmailSpooler::STATUS_PENDING;
        $emailSpooler->save();
    }

    /**
     * Envia el correo de servicios adquiridos
     *
     * @param Reservation $reservation
     */
    public static function sendHiredService(Reservation $reservation)
    {
        $handler = new AvailabilityServiceHandler([
            'reserva_id' => $reservation->reserva_id_erp,
            'funcion' => 'checkin'
        ]);
        $handler->processHandler();
        $data = $handler->getData();

        $experienceName = '';
        $reservation_instance = Reservation::where('localizador_erp', $reservation['localizador_erp'])->first();
        
        foreach ($reservation->experience->fieldTranslations as $fieldTranslation) {
            if ($fieldTranslation['iso'] === 'es') {
                foreach ($fieldTranslation['fields'] as $field) {
                    if ($field['field'] === 'nombre') {
                        $experienceName = $field['translation'];
                        break(2);
                    }
                }
            }
        }
        $cancellationPolicy = $reservation->cancelation_policy->nombre === 'NR' ? CTrans::trans('email.subject.hiredServices.reimbursable', $reservation_instance->iso) : CTrans::trans('email.subject.hiredServices.flexible', $reservation_instance->iso);

        $services = [];
        foreach ($data['data']['list']['extras']['extras_contratados'] as $extra) {
            $extraInstance = Extra::find($extra['id']);
            $extraName = '';
            foreach ($extraInstance->fieldTranslations as $fieldTranslation) {
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

        self::send('email.hiredServices', CTrans::trans('email.subject.hiredServices', $reservation_instance->iso), [$reservation->user->email], [
            'data' => [
                'locator' => $reservation->localizador_erp,
                'name' => $reservation->user->name . ' ' . $reservation->user->last_name,
                'apartment' => $reservation->apartment->nombre,
                'experience' => $experienceName,
                'cancellationPolicy' => $cancellationPolicy,
                'services' => $services,
                'status' => CTrans::trans('email.subject.hiredServices.paid', $reservation_instance->iso),
                'iso' => $reservation_instance->iso
            ]
        ]);
    }

    /**
     * Envia el correo nuevoExtraLanding del erp
     *
     * @param $params
     */
    public static function sendHiredServiceErp($params)
    {
        $experienceName = '';
        $reservation_instance = ERPService::completeInfo(['reserva_id'=>$params['reserva_id']]);
        
        $experienceName = $reservation_instance['data']['experiencia']['nombre'];
        $cancellationPolicy = $reservation_instance['data']['politica_cancelacion']['nombre'] === 'NR' ? CTrans::trans('email.subject.hiredServices.reimbursable', $params['iso']) : CTrans::trans('email.subject.hiredServices.flexible', $params['iso']);
        
        $services = [];
        foreach ($params['extras'] as $extra) {
            $extraInstance = Extra::find($extra['id']);
            $extraInstance['precio'] = Extra::calcularIva($extraInstance['base_imponible'],$extraInstance['iva_tipo']);
            $extraName = '';
            foreach ($extraInstance->fieldTranslations as $fieldTranslation) {
                if ($fieldTranslation['iso'] === $params['iso']) {
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
                'amount' => $extraInstance['precio']['total']
            ];
        }

        self::send('email.hiredServices', CTrans::trans('email.subject.hiredServices', $params['iso']), [$reservation_instance['data']['cliente']['email']], [
            'data' => [
                'locator' => $reservation_instance['data']['localizador'],
                'name' => $reservation_instance['data']['cliente']['nombre'] . ' ' . $reservation_instance['data']['cliente']['apellido'],
                'apartment' => $reservation_instance['data']['apartamento']['nombre'],
                'experience' => $experienceName,
                'cancellationPolicy' => $cancellationPolicy,
                'services' => $services,
                'status' => CTrans::trans('summary.pending', $params['iso']),
                'iso' => $params['iso']
            ]
        ]);
    }
}