<?php
namespace App\Service;

use App\EmailSpooler;
use App\Extra;
use App\Handler\AvailabilityServiceHandler;
use App\Reservation;

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
     * @param array $recipients
     * @param array $params
     */
    public static function send($view, array $recipients, array $params = [])
    {
        $emailSpooler = new EmailSpooler();
        $emailSpooler->view = $view;
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

        $reservation->experience->fieldTranslations = $reservation->experience->fieldTranslations();
        $experienceName = '';
        foreach ($reservation->experience->fieldTranslation as $fieldTranslation) {
            if ($fieldTranslation['iso'] === 'es') {
                foreach ($fieldTranslation['fields'] as $field) {
                    if ($field['field'] === 'nombre') {
                        $experienceName = $field['translation'];
                        break(2);
                    }
                }
            }
        }
        $cancellationPolicy = $reservation->cancelation_policy->nombre === 'NR' ? 'No reembolsable' : 'Flexible';

        $services = [];
        foreach ($data['data']['list']['extras']['extras_contratados'] as $extra) {
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
                'amount' => $extra['precio']
            ];
        }

        self::send('email.hiredService', [$reservation->user->email], [
            'locator' => $reservation->localizador_erp,
            'name' => $reservation->user->name . ' ' . $reservation->user->last_name,
            'apartment' => $reservation->apartment->nombre,
            'experience' => $experienceName,
            'cancellationPolicy' => $cancellationPolicy,
            'services' => $services,
            'status' => 'Pagado'
        ]);
    }
}