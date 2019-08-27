<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationMachineTermns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $translation = [
            'key' => 'termsConditions.text',
            'translation' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit'
        ];

        $device = \App\DeviceType::query()->where('code', 'machine')->first();
        $languages = \App\Language::all();

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = $translation['key'];
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit'
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
