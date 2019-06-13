<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationsForgot extends Migration
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
                'key' => 'layouts.forgot.success',
                'translation' => 'Te enviamos un mensaje a la siguiente dirección'
            ],
            [
                'key' => 'layouts.forgot.nofound',
                'translation' => 'Correo electrónico inválido'
            ],
            [
                'key' => 'layout.loginIndex.userData.sex',
                'translation' => 'Sexo'
            ],
            [
                'key' => 'layout.loginIndex.userData.country',
                'translation' => 'País'
            ],
            [
                'key' => 'layout.loginIndex.userData.city',
                'translation' => 'Ciudad'
            ],
            [
                'key' => 'message.spg.includes',
                'translation' => '¿Qué incluye?'
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
