<?php
namespace App\Handler;
use App\DeviceType;
use App\Language;

/**
 * Obtiene todos los idiomas disponibles con sus
 * traducciones
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class ListTranslationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $deviceType = DeviceType::query()->where('code', $this->params['device'])->first();

        if (! $deviceType) {
            throw new \Exception('Device not found');
        }

        $languages = Language::query()
            ->where('status', Language::STATUS_ACTIVE)
            ->get();

        $response = [];
        foreach ($languages as $lang) {

            $temp = [
                'name' => $lang->name,
                'iso' => $lang->iso,
                'flag' => urldecode(route('storage.image', ['image' => str_replace('/', '-', $lang->flag)])),
                'translations' => []
            ];

            $keyTranslations =  $lang->keyTranslations()->where('device_type_id', $deviceType->id)->get();

            foreach ($keyTranslations as $keyTranslation) {
                $temp['translations'][] = [
                    'key' => $keyTranslation->key,
                    'value' => $keyTranslation->pivot->translation
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
    protected function validationRules()
    {
        return [
            'device' => 'required'
        ];
    }

}