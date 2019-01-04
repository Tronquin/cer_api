<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationWeekDays extends Migration
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
        $keyTranslation->key = 'label.day.monday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Lunes' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.tuesday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Martes' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.wednesday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Miercoles' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.thursday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Jueves' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.friday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Viernes' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.saturday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Sábado' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'label.day.sunday';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Domingo' : ''
            ]);
        }

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'layouts.footer.gracia';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Gracia' : ''
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
