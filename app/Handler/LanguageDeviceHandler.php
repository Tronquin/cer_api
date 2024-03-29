<?php
namespace App\Handler;


use App\Language;
use App\Service\UrlGenerator;

class LanguageDeviceHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $languages = Language::query()
            ->where('status', Language::STATUS_ACTIVE)
            ->get();

        $response = [];
        foreach ($languages as $lang) {

            $temp = [
                'name' => $lang->name,
                'iso' => $lang->iso,
                'flag' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $lang->flag)]),
                'translations' => []
            ];

            $keyTranslations =  $lang->keyTranslations()->with('deviceType')->get();

            foreach ($keyTranslations as $keyTranslation) {

                $temp['translations'][$keyTranslation->deviceType->code][] = [
                    'key' => $keyTranslation->key,
                    'value' => $keyTranslation->pivot->translation,
                    'keyId' => $keyTranslation->id,
                ];
            }

            $response[] = $temp;
        }

        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    public function validationRules()
    {
        return [];
    }
}