<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $translations = [
            [
                'key' => 'message.spg.details',
                'translation' => 'Más detalles'
            ],
            [
                'key' => 'message.spg.back',
                'translation' => 'Volver'
            ],
            [
                'key' => 'message.spg.book',
                'translation' => '¡Quiero reservar!'
            ]
        ];

        $device = \App\DeviceType::query()->where('code', 'web')->first();
        $languages = \App\Language::all();

        foreach ($translations as $translation) {

            $keyTranslation = new App\KeyTranslation();
            $keyTranslation->key = $translation['key'];
            $keyTranslation->device_type_id = $device->id;
            $keyTranslation->save();

            foreach ($languages as $language) {
                $keyTranslation->languages()->attach($language->id, [
                    'translation' => $language->iso === 'es' ?
                        $translation['translation'] : \App\Service\TranslationService::trans($translation['translation'], 'es', $language->iso)['text'][0]
                ]);
            }
        }

        Schema::table('extras', function (Blueprint $table) {
            $table->string('front_image_large')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn('front_image_large');
        });
    }
}
