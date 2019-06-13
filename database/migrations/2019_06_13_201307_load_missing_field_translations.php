<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoadMissingFieldTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $language = \App\Language::query()->where('iso', 'es')->first();
        $fieldTranslationsES = \App\FieldTranslation::query()->where('language_id', $language->id)->get();

        foreach ($fieldTranslationsES as $fieldTranslation) {
            if (! empty($text = $fieldTranslation->translation)) {

                $fieldTranslationsOthers = \App\FieldTranslation::query()
                    ->with(['language'])
                    ->where('content_type', $fieldTranslation->content_type)
                    ->where('content_id', $fieldTranslation->content_id)
                    ->where('field', $fieldTranslation->field)
                    ->where('language_id', '<>', $language->id)
                    ->get();

                foreach ($fieldTranslationsOthers as $other) {
                    if (empty($other->translation)) {
                        $other->translation = \App\Service\TranslationService::trans($text, 'es', $other->language->iso)['text'][0];
                        $other->save();
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
