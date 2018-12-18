<?php
namespace App\TraitDefinition;

use App\FieldTranslation;
use App\Language;

trait FieldTranslationTrait
{
    public function fieldTranslations()
    {
        $translations = FieldTranslation::query()
            ->where('content_id', $this->id)
            ->where('content_type', self::class)
            ->with(['language'])
            ->get()
        ;
        $languages = Language::get(['iso','name']);

        $response = [];
        foreach ($translations as $translation) {
            $response[$translation->language->iso][] = [
                'field' => $translation->field,
                'translation' => $translation->translation
            ];
        }

        return $response = [
            'fieldTranslations' => $response,
            'languages' => $languages
        ];
    }
}