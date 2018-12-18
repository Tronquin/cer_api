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


    public function updateFieldTranslations(array $fieldTranslations){
        
        $languages = Language::all();

        foreach($languages as $language){
            foreach($fieldTranslations as $field){
                
                if($field['iso'] == $language->iso){
                    foreach($field['fields'] as $fieldTranslation){

                        if (! in_array($fieldTranslation['field'], $this->fieldsToTranslate())) {
                            continue;
                        }

                        $translation = FieldTranslation::where('content_id',$this->id)
                                ->where('content_type',self::class)
                                ->where('field',$fieldTranslation['field'])
                                ->where('language_id',$language->id)
                                ->firstOrNew([]);
    
                                $translation->content_id = $this->id;
                                $translation->content_type = self::class;
                                $translation->language_id = $language->id;
                                $translation->field = $fieldTranslation['field'];
                                $translation->translation = $fieldTranslation['translation'];
    
                                $translation->save();
                    }
                }
            }
        }

    }
}