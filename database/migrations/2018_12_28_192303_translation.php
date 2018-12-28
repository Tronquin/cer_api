<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Translation extends Migration
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
        $keyTranslation->key = 'layouts.navbar.logout';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Salir' : ''
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
