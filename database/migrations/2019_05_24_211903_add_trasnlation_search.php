<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrasnlationSearch extends Migration
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
                'key' => 'pages.searchResult.resultsPlural',
                'translation' => 'Disponible {n} resultados para tu búsqueda'
            ],
            [
                'key' => 'pages.payment.byNight',
                'translation' => 'por noche'
            ],
            [
                'key' => 'pages.payment.byPax',
                'translation' => 'por persona'
            ],
            [
                'key' => 'pages.payment.byNightbyPax',
                'translation' => 'por noche por persona'
            ],
            [
                'key' => 'pages.payment.direct',
                'translation' => 'Reserva directa'
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
