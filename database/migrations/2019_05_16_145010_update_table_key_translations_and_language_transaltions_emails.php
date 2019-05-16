<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableKeyTranslationsAndLanguageTransaltionsEmails extends Migration
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

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'emails.confirmacionreserva.title';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Confirmacion de Reserva' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.checkin';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Check-In' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.checkout';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Check-Out' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.localizadorreserva';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Localizador de Reserva' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.nombre';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Nombre' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.pax';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Pax' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.apartamento';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Apartamento' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.tipodeapartamento';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Tipo de Apartamento' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.tipoderegimen';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Tipo de Regimen' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.experiencia';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Experiencia' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.portal';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Portal' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.politicadecancelacion';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Politica de Cancelación' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.queincluyemiexp';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Que incluye mi experiencia?' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.resumendpago';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Resumen de Pago' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.serviciosextras';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Servicios Extras' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.total';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Total' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.ivaincluido';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'iva incluido' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.online';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Online' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.direccion';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Dirección' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.ubicarenmapa';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Ubicar en el mapa' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.tienesdudas';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? '¿Tienes dudas?' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.contactanos';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Contáctanos' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.siguenosenredes';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Siguenos en nuestras redes' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.descargaapp';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Descarga nuestra App' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'emails.confirmacionreserva.descripcion';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhfssfsfsg euisfsmod tincidunt laoreet dolore magna aliquam.' : ''
            ]);
        }

        $keyTranslations = \App\KeyTranslation::query()->with(['languages'])->get();

        foreach ($keyTranslations as $keyTranslation) {

            $text = '';
            foreach ($keyTranslation->languages as $language) {
                // Obtengo texto en español
                if ($language->iso === 'es') {
                    $text = $language->pivot->translation;
                    break;
                }
            }

            if (! empty($text)) {

                foreach ($keyTranslation->languages as $language) {
                    if ($language->iso !== 'es' && empty($language->pivot->translation)) {
                        $language->pivot->translation = \App\Service\TranslationService::trans($text, 'es', $language->iso)['text'][0];
                        $language->pivot->save();
                    }
                }
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
