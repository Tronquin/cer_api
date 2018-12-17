<?php
namespace App\TraitDefinition;

use App\FieldTranslation;

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

        $response = [];
        foreach ($translations as $translation) {
            $response[$translation->language->iso][] = [
                'field' => $translation->field,
                'translation' => $translation->translation
            ];
        }

        return $response;
    }
}