<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationPayment extends Migration
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

        $translations = [
            [
                'key' => 'pages.searchResult.choose',
                'translation' => '¿Qué tipo de servicio deseas para tu estadía?'
            ],
            [
                'key' => 'pages.searchResult.back',
                'translation' => 'Volver'
            ],
            [
                'key' => 'pages.searchResult.next',
                'translation' => 'Continuar'
            ],
            [
                'key' => 'pages.payment.typology',
                'translation' => 'Tipologia'
            ],
            [
                'key' => 'pages.payment.regimen',
                'translation' => 'Regimen'
            ],
            [
                'key' => 'pages.payment.experience',
                'translation' => 'Experiencia'
            ],
            [
                'key' => 'pages.payment.politics',
                'translation' => 'Politica'
            ],
            [
                'key' => 'pages.payment.month',
                'translation' => 'Mes'
            ],
            [
                'key' => 'pages.payment.year',
                'translation' => 'Año'
            ]
        ];

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
