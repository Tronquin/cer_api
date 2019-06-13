<?php

namespace App\Console\Commands;

use App\Location;
use App\Reservation;
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
            ->with([
                'user',
                'typology',
                'experience.extras',
                'apartment.tipologia'
            ])
            ->where('checkin', '>=', $now)
            ->where('checkin', '<=', $after48)
            ->get();

        foreach ($reservations as $reservation) {

            $location = Location::query()->where('ubicacion_id', $reservation->ubicacion_id)->first();

            foreach ($reservation->experience->extras as $extra) {
                $extra->extraName = $extra->getFieldTranslation('nombre', $reservation->iso);
            }

            $data = $reservation->toArray();
            $data['apartmentName'] = $reservation->apartment->tipologia->getFieldTranslation('nombre', $reservation->iso);
            $data['dormitorios'] = $reservation->apartment->tipologia->dormitorios()->count();
            $data['lavabos'] = $reservation->apartment->tipologia->lavabos()->count();
            $data['experienceName'] = $reservation->experience->getFieldTranslation('name', $reservation->iso);
            $data['address'] = $location->direccion;

            if ($reservation->emailSent && ($reservation->checkin >= $after24 && $reservation->checkin <= $after48)) {

                // Enviar correo de 48 horas
                EmailService::send(
                    'email.48hEmail',
                    CTrans::trans('email.subject.48hs', $reservation->iso),
                    [$reservation->user->email],
                    [
                        'data' => [
                            'reserva' => $data,
                            'lang' => $reservation->iso
                        ],
                    ]
                );
                $reservation->emailSent = true;

            } elseif ($reservation->emailSent && $reservation->checkin <= $after24) {

                // Enviar correo de 24 horas
                EmailService::send(
                    'email.24hours',
                    CTrans::trans('email.subject.24hs', $reservation->iso),
                    [$reservation->user->email],
                    [
                        'data' => [
                            'reserva' => $data,
                            'lang' => $reservation->iso
                        ],
                    ]
                );
                $reservation->emailSent = true;

            } else {
                continue;
            }

            $reservation->save();
        } 
    }
}
