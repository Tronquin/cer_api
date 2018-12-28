<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Translations extends Migration
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

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.checkin';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'CHECK-IN' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.checkout';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'CHECK-OUT' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.location';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Localizador' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.exito';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El pago de tu reserva se realizó con éxito' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.sendCompro';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Le hemos enviado el comprobante y confirmación de pago a su correo electrónico' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.sendCompro';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Le hemos enviado el comprobante y confirmación de pago a su correo electrónico' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layouts.navbar.welcome';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Bienvenido' : ''
            ]);
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
