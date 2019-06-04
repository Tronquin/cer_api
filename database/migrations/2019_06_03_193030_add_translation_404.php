<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslation404 extends Migration
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
                'key' => 'layouts.error.nofound',
                'translation' => 'No hemos encontrado'
            ],
            [
                'key' => 'layouts.error.page',
                'translation' => 'la página solicitada'
            ],
            [
                'key' => 'layouts.forgot.submit',
                'translation' => 'Recuperar contraseña'
            ],
            [
                'key' => 'layouts.forgot.recovery',
                'translation' => 'Por favor, introduce tu correo electrónico y recibirás los pasos para restablecer tu contraseña'
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
