<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoadMissingTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $keyTranslations = \App\KeyTranslation::query()->with(['languages'])->get();

        foreach ($keyTranslations as $keyTranslation) {

            $text = '';
            foreach ($keyTranslation->languages as $language) {
                // Obtengo texto en español
                if ($language->iso === 'es') {
                    $text = $language->pivot->translation;
                    break;
                }
            }

            if (! empty($text)) {

                foreach ($keyTranslation->languages as $language) {
                    if ($language->iso !== 'es' && empty($language->pivot->translation)) {
                        $language->pivot->translation = \App\Service\TranslationService::trans($text, 'es', $language->iso)['text'][0];
                        $language->pivot->save();
                    }
                }
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
