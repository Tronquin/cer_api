<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationMetaTags extends Migration
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
        $metaTitleText = 'Apartamentos de lujo en Barcelona';
        $metaDescriptionText = 'Reserva tus vacaciones de lujo en Barcelona con nuestros apartamentos exclusivos en Sagrada Familia. Servicios vip, spa, traslados al aeropuerto, entre otros.';
        $pageTitle = 'Apartamentos de lujo en Barcelona';

        // META TITLE
        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'home.meta.title';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $text = $metaTitleText;
            if ($language->iso !== 'es') {
                $text = \App\Service\TranslationService::trans($text, 'es', $language->iso)['text'][0];
            }

            $keyTranslation->languages()->attach($language->id, [
                'translation' => $text
            ]);
        }

        // META DESCRIPTION
        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'home.meta.description';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $text = $metaDescriptionText;
            if ($language->iso !== 'es') {
                $text = \App\Service\TranslationService::trans($text, 'es', $language->iso)['text'][0];
            }

            $keyTranslation->languages()->attach($language->id, [
                'translation' => $text
            ]);
        }

        // PAGE TITLE
        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'layout.page.title';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $text = $pageTitle;
            if ($language->iso !== 'es') {
                $text = \App\Service\TranslationService::trans($text, 'es', $language->iso)['text'][0];
            }

            $keyTranslation->languages()->attach($language->id, [
                'translation' => $text
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
