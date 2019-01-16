<?php
namespace App\Service;

use App\EmailSpooler;

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
}