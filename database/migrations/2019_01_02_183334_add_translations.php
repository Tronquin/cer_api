<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslations extends Migration
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
        $keyTranslation->key = 'layout.servicios.label.selectedReserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Debe seleccionar una reserva antes de añadir servicios' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layout.servicios.label.selectRes';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Seleccione Reserva' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layout.servicios.label.select';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Seleccione' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layout.servicios.label.reserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Reserva' : ''
            ]);
        }

        $keyTranslation = \App\KeyTranslation::query()->where('key', 'layout.loginIndex.services.loadServices')->first();

        foreach ($keyTranslation->languages as $language) {
            if ($language->iso === 'es') {
                $language->pivot->translation = 'Cargar más servicios';
                $language->pivot->save();
            }
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layout.servicios.transactionSuccess';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Transacción realizada. Nuevos extras agregados correctamente' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'layout.servicios.transactionError';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Transacción fallida. Hubo un error al procesar pago' : ''
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
