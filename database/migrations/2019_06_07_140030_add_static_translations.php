<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaticTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $device = \App\DeviceType::query()->where('code', 'web')->first();
        $languages = \App\Language::all();

        $translations = [
            [
                'key' => 'pages.header.welcome',
                'translation' => 'Bienvenido'
            ],
            [
                'key' => 'pages.header.preheader',
                'translation' => "(Optional) This text will appear in the inbox preview, but not the email body. It can be used to supplement the email subject line or even summarize the email's contents. Extended text preheaders (~490 characters) seems like a better UX for anyone using
                a screenreader or voice-command apps like Siri to dictate the contents of an email. If this text is not included, email clients will automatically populate it using the text (including image alt text) at the start of the email's body."
            ],
            [
                'key' => 'pages.footer.contactUs',
                'translation' => '¿Tienes dudas? Contáctanos'
            ],
            [
                'key' => 'pages.footer.followUs',
                'translation' => 'Síguenos en nuestras redes'
            ],
            [
                'key' => 'pages.footer.downloadApp',
                'translation' => 'Descarga nuestra App'
            ],
            [
                'key' => 'pages.footer.copyright',
                'translation' => 'Copyright © 2018 castro Exclusive Residences All Rights Reserved'
            ],
            [
                'key' => 'pages.booking.tracker',
                'translation' => 'Localizador de reserva'
            ],
            [
                'key' => 'pages.booking.arrival',
                'translation' => 'Hora de Llegada'
            ],
            [
                'key' => 'pages.booking.access',
                'translation' => 'Recuerda que podrás acceder a tu apartamento antes de las 16:00h, o puedes entrar antes contratando el servicio de Early Check In'
            ],
            [
                'key' => 'pages.booking.name',
                'translation' => 'Nombre'
            ],
            [
                'key' => 'pages.booking.apartament',
                'translation' => 'Apartamento'
            ],
            [
                'key' => 'pages.booking.apartamentType',
                'translation' => 'Tipo de apartamento'
            ],
            [
                'key' => 'pages.booking.regimen',
                'translation' => 'Tipo de Régimen'
            ],
            [
                'key' => 'pages.booking.experience',
                'translation' => 'Experiencia'
            ],
            [
                'key' => 'pages.booking.extraExperience',
                'translation' => 'Servicios extra'
            ],
            [
                'key' => 'pages.booking.payStatus',
                'translation' => 'Estado del pago'
            ],
            [
                'key' => 'pages.booking.politic',
                'translation' => 'Política de cancelación'
            ],
            [
                'key' => 'pages.booking.myExperience',
                'translation' => '¿Qué incluye mi experiencia?'
            ],
            [
                'key' => 'pages.booking.otherServices',
                'translation' => 'Otros servicios que puedes contratar'
            ],
            [
                'key' => 'pages.booking.packageService',
                'translation' => 'Guardamaletas<br> <b>€10 por día</b>'
            ],
            [
                'key' => 'pages.booking.petService',
                'translation' => 'Trae tu mascota<br> <b>€10 por día</b>'
            ],
            [
                'key' => 'pages.24Hours.title',
                'translation' => "6-24Horas"
            ],
            [
                'key' => 'pages.24Hours.until',
                'translation' => '¡Faltan 24 horas para tu llegada!'
            ],
            [
                'key' => 'pages.24Hours.checkin',
                'translation' => 'Check In'
            ],
            [
                'key' => 'pages.24Hours.checkout',
                'translation' => 'Check Out'
            ],
            [
                'key' => 'pages.24Hours.timeBarcelona',
                'translation' => 'El tiempo en Barcelona'
            ],
            [
                'key' => 'pages.24Hours.peticions',
                'translation' => 'Peticiones especiales'
            ],
            [
                'key' => 'pages.24Hours.address',
                'translation' => 'Dirección'
            ],
            [
                'key' => 'pages.24Hours.torrijo',
                'translation' => 'Carrer de Torrijos'
            ],
            [
                'key' => 'pages.days.monday',
                'translation' => 'Lunes'
            ],
            [
                'key' => 'pages.days.tuesday',
                'translation' => 'Martes'
            ],
            [
                'key' => 'pages.days.wednesday',
                'translation' => 'Miércoles'
            ],
            [
                'key' => 'pages.days.thursday',
                'translation' => 'Jueves'
            ],
            [
                'key' => 'pages.days.friday',
                'translation' => 'Viernes'
            ],
            [
                'key' => 'pages.days.saturday',
                'translation' => 'Sábado'
            ],
            [
                'key' => 'pages.days.sunday',
                'translation' => 'Domingo'
            ],
            [
                'key' => 'pages.48Hours.title',
                'translation' => '48 Horas'
            ],
            [
                'key' => 'pages.48Hours.until',
                'translation' => '¡Faltan 48 horas para tu llegada!'
            ],
            [
                'key' => 'pages.48Hours.earlyCheckIn',
                'translation' => 'Early Check In'
            ],
            [
                'key' => 'pages.48Hours.experience',
                'translation' => 'Tu experiencia incluye'
            ],
            [
                'key' => 'pages.48Hours.otherServices',
                'translation' => 'Otros servicios que puedes contratar'
            ],
            [
                'key' => 'pages.booking.adult',
                'translation' => 'adultos'
            ],
            [
                'key' => 'pages.booking.child',
                'translation' => 'niños'
            ],
            [
                'key' => 'pages.booking.rooms',
                'translation' => 'dormitorios'
            ],
            [
                'key' => 'pages.booking.bath',
                'translation' => 'baños'
            ],
            [
                'key' => 'pages.48Hours.access',
                'translation' => 'Instrucciones de acceso'
            ],
            [
                'key' => 'pages.booking.payResume',
                'translation' => 'Resumen de pago'
            ],
            [
                'key' => 'pages.booking.concept',
                'translation' => 'Concepto'
            ],
            [
                'key' => 'pages.booking.amount',
                'translation' => 'Cantidad'
            ],
            [
                'key' => 'pages.booking.total',
                'translation' => 'Importe'
            ],
            [
                'key' => 'pages.booking.iva',
                'translation' => 'Total (IVA incluido)'
            ],
            [
                'key' => 'pages.cancelBooking.title',
                'translation' => 'Cancelación de Reserva'
            ],
            [
                'key' => 'pages.cancelBooking.success',
                'translation' => 'Se ha cancelado tu reserva'
            ],
            [
                'key' => 'pages.checkout.title',
                'translation' => 'Check Out'
            ],
            [
                'key' => 'pages.checkout.thanks',
                'translation' => '¡Gracias por alojarte en castro Exclusive Residences!'
            ],
            [
                'key' => 'pages.checkout.waiting',
                'translation' => 'Esperamos que hayas tenido una estancia extraordinaria con nosotros.'
            ],
            [
                'key' => 'pages.checkout.resume1',
                'translation' => 'Aquí está tu'
            ],
            [
                'key' => 'pages.checkout.resume2',
                'translation' => 'resumen de pago'
            ],
            [
                'key' => 'pages.hired.title',
                'translation' => 'Confirmación de Reserva'
            ],
            [
                'key' => 'pages.hired.extraServices',
                'translation' => 'Servicios extra contratados'
            ],
            [
                'key' => 'pages.rate.title',
                'translation' => 'Confirmación de Reserva'
            ],
            [
                'key' => 'pages.rate.forUs',
                'translation' => 'Para nosotros tu opinión es importante'
            ],
            [
                'key' => 'pages.rate.rateUs',
                'translation' => 'Nos encantaría que tú y tus acompañantes<b> valoren la estancia </b>.¡No te quitará mucho tiempo!'
            ],
            [
                'key' => 'pages.rate.google+',
                'translation' => 'Valora tu estancia en'
            ],
            [
                'key' => 'pages.register.congrats',
                'translation' => '¡Enhorabuena!'
            ],
            [
                'key' => 'pages.register.userReg',
                'translation' => 'Has creado tu cuenta con éxito.'
            ],
            [
                'key' => 'pages.register.userRegComplement',
                'translation' => 'Esperamos que disfrutes tu estancia en'
            ],
            [
                'key' => 'pages.register.user',
                'translation' => 'Usuario'
            ],
            [
                'key' => 'pages.register.password',
                'translation' => 'Clave temporal'
            ],
            [
                'key' => 'pages.reservationUpdate.title',
                'translation' => 'Confirmación de Reserva'
            ],
            [
                'key' => 'pages.reservationUpdate.bookingModified',
                'translation' => 'Tu reserva se ha modificado'
            ],
            [
                'key' => 'pages.reservationUpdate.bookingChanged',
                'translation' => 'Parece que has realizado cambios en tu reserva. A continuación te los indicamos en '
            ],
            [
                'key' => 'pages.reservationUpdate.yellow',
                'translation' => 'color amarillo'
            ],
            [
                'key' => 'pages.reservationUpdate.iva',
                'translation' => '<b>Total</b> (IVA incluído)'
            ],
            [
                'key' => 'pages.reservationUpdate.checkOnline',
                'translation' => 'Check In Online'
            ],
            [
                'key' => 'pages.reservationUpdate.checkOnlineText',
                'translation' => 'Realiza tu check-in online y ahorra tiempo cuando llegues a Barcelona, para que puedas disfrutar tu estancia desde el primer momento.'
            ],
            [
                'key' => 'pages.reservationUpdate.mapTracker',
                'translation' => 'Ubicar en el mapa'
            ],
            [
                'key' => 'pages.psswrd.title',
                'translation' => '¿Necesitas reiniciar tu contraseña?'
            ],
            [
                'key' => 'pages.psswrd.reset',
                'translation' => 'Reiniciar Contraseña'
            ],
            [
                'key' => 'pages.body.click',
                'translation' => 'CLICK AQUI'
            ]
        ];

        foreach ($translations as $translation) {

            $keyTranslation = new App\KeyTranslation();
            $keyTranslation->key = $translation['key'];
            $keyTranslation->device_type_id = $device->id;
            $keyTranslation->save();

            foreach ($languages as $language) {
                $keyTranslation->languages()->attach($language->id, [
                    'translation' => $language->iso === 'es' ?
                        $translation['translation'] :
                        \App\Service\TranslationService::trans($translation['translation'], 'es', $language->iso)['text'][0]
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
