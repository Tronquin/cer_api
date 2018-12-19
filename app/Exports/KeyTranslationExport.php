<?php

namespace App\Exports;

use App\KeyTranslation;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeyTranslationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $keyTranslations = KeyTranslation::query()
            ->with(['languages'])
            ->get(['id', 'key']);

        foreach ($keyTranslations as $keyTranslation) {
            $keyTranslation->translation = $keyTranslation->languages[0]->pivot->translation;
            unset($keyTranslation->id);
        }

        return $keyTranslations;
    }
}
