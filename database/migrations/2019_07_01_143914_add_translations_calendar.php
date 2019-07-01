<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationsCalendar extends Migration
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
                'key' => 'label.month.january',
                'translation' => 'Enero'
            ],
            [
                'key' => 'label.month.february',
                'translation' => 'Febrero'
            ],
            [
                'key' => 'label.month.march',
                'translation' => 'Marzo'
            ],
            [
                'key' => 'label.month.april',
                'translation' => 'Abril'
            ],
            [
                'key' => 'label.month.may',
                'translation' => 'Mayo'
            ],
            [
                'key' => 'label.month.june',
                'translation' => 'Junio'
            ],
            [
                'key' => 'label.month.july',
                'translation' => 'Julio'
            ],
            [
                'key' => 'label.month.august',
                'translation' => 'Agosto'
            ],
            [
                'key' => 'label.month.september',
                'translation' => 'Septiembre'
            ],
            [
                'key' => 'label.month.october',
                'translation' => 'Octubre'
            ],
            [
                'key' => 'label.month.november',
                'translation' => 'Noviembre'
            ],
            [
                'key' => 'label.month.december',
                'translation' => 'Diciembre'
            ],
            [
                'key' => 'pages.searchResult.offer',
                'translation' => 'Oferta Especial'
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
