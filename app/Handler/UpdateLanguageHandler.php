<?php
namespace App\Handler;

use App\Language;

/**
 * Actualiza idiomas claves y traducciones
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class UpdateLanguageHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = $this->params['language'];

        $language = Language::where('iso', $data['iso'])->firstOrFail();

        foreach ($data['translations'] as $device) {
            foreach ($device as $translation) {

                $keyTranslation = $language->keyTranslations()->find($translation['keyId']);
                $keyTranslation->key = $translation['key'];
                $keyTranslation->save();

                $keyTranslation->pivot->translation = empty($translation['value']) ? '' : $translation['value'];
                $keyTranslation->pivot->save();
            }
        }

        return [
            'res' => 1,
            'msg' => 'Idioma actualizado',
            'data' => [
                compact('language')
            ]
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'language' => 'required'
        ];
    }

}