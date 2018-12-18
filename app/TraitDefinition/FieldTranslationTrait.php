<?php
namespace App\TraitDefinition;

use App\FieldTranslation;
use App\Language;

trait FieldTranslationTrait
{
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
            ->get()
        ;
        $languages = Language::get(['iso','name', 'id']);

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

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    abstract public function fieldsToTranslate();
}