<?php

namespace App\Console\Commands;

use App\Reservation;
use App\Service\ERPService;
use App\Service\EmailService;
use Illuminate\Console\Command;
use CTrans;

class SendUntilEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cer:emailUntil:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica si la fecha de checkin coincide con la fecha actual para comprobar que se envien los correos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = new \DateTime();
        $after24 = new \DateTime('+24 hours');
        $after48 = new \DateTime('+48 hours');
        
        $reservations = Reservation::query()
            ->where('checkin', '>=', $now)
            ->where('checkin', '<=', $after48)
            ->get();

        $data = [];
        /* $response = ERPService::completeInfo(); */
        $data['reserva'] = $response['data'];

        foreach ($reservations as $reservation) {

            if ($reservation->emailSent && ($reservation->checkin >= $after24 && $reservation->checkin <= $after48)) {
                // Enviar correo de 48 horas
                EmailService::send('email.48hEmail', CTrans::trans('email.subject.48hs', $reservation->iso),[$data['reserva']['cliente']['email']],['data' => $data]);
                $reservation->emailSent = true;
            } elseif ($reservation->emailSent && $reservation->checkin <= $after24) {
                // Enviar correo de 24 horas
                EmailService::send('email.24hours', CTrans::trans('email.subject.24hs', $reservation->iso),[$data['reserva']['cliente']['email']],['data' => $data]);
                $reservation->emailSent = true;
            } else {
                continue;
            }

            $reservation->save();
        } 
    }
}
