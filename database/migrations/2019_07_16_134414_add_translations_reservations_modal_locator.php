<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationsReservationsModalLocator extends Migration
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
                'key' => 'layout.loginIndex.reservation.buttonLocator',
                'translation' => 'Agregar con localizador'
            ],
            [
                'key' => 'layout.loginIndex.reservation.titleLocator',
                'translation' => 'Ingrese el localizador de su reserva'
            ],
            [
                'key' => 'layout.loginIndex.reservation.inputLocator',
                'translation' => 'Localizador'
            ],
            [
                'key' => 'layout.loginIndex.reservation.locatorError',
                'translation' => 'Ingrese un localizador valido'
            ],
            [
                'key' => 'layout.loginIndex.reservation.sendLocator',
                'translation' => 'Agregar'
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
