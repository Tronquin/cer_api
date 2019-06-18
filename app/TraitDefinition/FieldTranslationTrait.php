<?php
namespace App\TraitDefinition;

use App\FieldTranslation;
use App\Language;
use App\Service\TranslationService;

trait FieldTranslationTrait
{
    public $fieldTranslationsData = [];
    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    abstract public function fieldsToTranslate();

    /**
     * Traducciones para los campos
     *
     * @return array
     */
    public function fieldTranslations()
    {
        $translations = FieldTranslation::query()
            ->where('content_id', $this->id)
            ->where('content_type', self::class)
            ->with(['language'])
            ->get();
        $languages = Language::query()->orderBy('main', 'DESC')->orderBy('id')->get(['iso', 'name', 'id']);

        $response = [];
        foreach ($languages as $language) {

            $tempResponse = [
                'iso' => $language->iso,
                'name' => $language->name,
                'fields' => []
            ];

            foreach ($this->fieldsToTranslate() as $field) {

                $trans = '';
                foreach ($translations as $translation) {
                    if ($translation->language_id === $language->id && $translation->field === $field) {
                        $trans = $translation->translation;
                    }
                }

                $tempResponse['fields'][] = [
                    'field' => $field,
                    'translation' => $trans
                ];
            }

            $response[] = $tempResponse;
        }

        return $response;
    }

    public function getFieldTranslationsAttribute()
    {
        return $this->fieldTranslations();
    }

    /**
     * Actualiza las traducciones para un registro
     *
     * @param array $fieldTranslations
     */
    public function updateFieldTranslations(array $fieldTranslations)
    {
        $language = Language::query()->where('iso', 'es')->first();

        foreach ($fieldTranslations as $field) {
            if ($field['iso'] == $language->iso) {
                // Si los textos en ingles son distintos a los almacenados, se cargan el resto de las traducciones
                // desde la api, sino se actualizan todas las traducciones con lo que llega del front

                foreach ($field['fields'] as $fieldTranslation) {

                    if (!in_array($fieldTranslation['field'], $this->fieldsToTranslate())) {
                        continue;
                    }

                    $translation = FieldTranslation::where('content_id', $this->id)
                        ->where('content_type', self::class)
                        ->where('field', $fieldTranslation['field'])
                        ->where('language_id', $language->id)
                        ->first();

                    if (
                        !$translation || ($translation && $translation->translation !== $fieldTranslation['translation'])
                    ) {
                        // No existe la traduccion || Existe y es distinta a la cargada
                        $this->translateFromApi($fieldTranslation['translation'] ?? '', $fieldTranslation['field']);
                    } else {
                        // Se asume ajustes menores an alguna traduccion, se guarda lo que llega del front
                        $this->saveTranslations($fieldTranslations, $fieldTranslation['field']);
                    }
                }
            }
        }
    }

    /**
     * Obtiene la traduccion de un campo
     *
     * @param string $key
     * @param string $iso
     * @return string
     */
    public function getFieldTranslation($key, $iso)
    {
        if (empty($this->fieldTranslationsData)) {
            $this->fieldTranslationsData = $this->fieldTranslations();
        }

        foreach ($this->fieldTranslationsData as $fieldTranslation) {
            if ($fieldTranslation['iso'] === $iso) {
                foreach ($fieldTranslation['fields'] as $field) {
                    if ($field['field'] === $key) {
                        return $field['translation'];
                    }
                }
            }
        }

        return '';
    }

    /**
     * Actualiza un campo en multiple idioma obteniendo traducciones desde una API
     *
     * @param string $transText
     * @param string $field
     */
    private function translateFromApi(string $transText, string $field)
    {
        $languages = Language::all();
        foreach ($languages as $language) {

            $translation = FieldTranslation::where('content_id', $this->id)
                ->where('content_type', self::class)
                ->where('field', $field)
                ->where('language_id', $language->id)
                ->firstOrNew([]);

            $trans = '';
            if ($language->iso === 'es') {
                $trans = $transText;
            } elseif (!empty($transText)) {
                $trans = TranslationService::trans($transText, 'es', $language->iso)['text'][0];
            }

            $translation->content_id = $this->id;
            $translation->content_type = self::class;
            $translation->language_id = $language->id;
            $translation->field = $field;
            $translation->translation = $trans;
            $translation->save();
        }
    }

    /**
     * Actualiza todas las traducciones normalmente
     *
     * @param array $fieldTranslations
     * @param string $fieldToSave
     */
    private function saveTranslations(array $fieldTranslations, string $fieldToSave)
    {
        $languages = Language::all();
        foreach ($languages as $language) {
            foreach ($fieldTranslations as $field) {

                if ($field['iso'] == $language->iso) {
                    foreach ($field['fields'] as $fieldTranslation) {

                        if (
                            !in_array($fieldTranslation['field'], $this->fieldsToTranslate()) ||
                            $fieldTranslation['field'] !== $fieldToSave
                        ) {
                            continue;
                        }

                        $translation = FieldTranslation::where('content_id', $this->id)
                            ->where('content_type', self::class)
                            ->where('field', $fieldTranslation['field'])
                            ->where('language_id', $language->id)
                            ->firstOrNew([]);

                        $translation->content_id = $this->id;
                        $translation->content_type = self::class;
                        $translation->language_id = $language->id;
                        $translation->field = $fieldTranslation['field'];
                        $translation->translation = $fieldTranslation['translation'] ?? '';
                        $translation->save();
                    }
                }
            }
        }
    }
}
