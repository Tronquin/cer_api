<?php
namespace App\Service;

use App\KeyTranslation;

/**
 * Traducciones "estaticas"
 *
 * uso simple: CTrans::trans('key', 'iso')
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class CERTranslator {

    /**
     * Translate form key_translations
     *
     * @param string $key
     * @param string $iso
     * @return string
     */
    public static function trans($key, $iso)
    {
        $translation = KeyTranslation::query()
            ->select(['language_translation.translation'])
            ->join('language_translation', 'language_translation.key_translation_id', '=', 'key_translations.id')
            ->join('languages', 'languages.id', '=', 'language_translation.language_id')
            ->where('key_translations.key', $key)
            ->where('languages.iso', $iso)
            ->first()
        ;

        if (! $translation) {
            return '';
        }

        return $translation->translation;
    }
}