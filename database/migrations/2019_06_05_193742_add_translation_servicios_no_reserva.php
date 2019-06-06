<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationServiciosNoReserva extends Migration
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
                'key' => 'components.loginIndex.noReserve',
                'translation' => 'No tienes ninguna reserva'
            ],
            [
                'key' => 'components.loginIndex.noReserveMessage',
                'translation' => 'Debes crear una reserva primero para poder acceder a esta opción. Haz click para reservar'
            ],
            [
                'key' => 'components.loginIndex.buttonReserve',
                'translation' => 'Reservar'
            ]
        ];

        $keys = \App\KeyTranslation::query()->whereIn('key', array_column($translations, 'key'))->get();
        foreach ($keys as $key) {
            $key->languages()->sync([]);
            $key->delete();
        }

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
