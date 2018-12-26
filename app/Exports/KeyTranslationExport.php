<?php

namespace App\Exports;

use App\DeviceType;
use App\KeyTranslation;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeyTranslationExport implements FromCollection
{
    protected $device;

    public function __construct($device)
    {
        $this->device = $device;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $device = $this->device ? DeviceType::query()->where('code', $this->device)->first() : null;

        $keyTranslations = KeyTranslation::query()->with(['languages']);

        if ($device) {
            $keyTranslations->where('device_type_id', $device->id);
        }

        $keyTranslations = $keyTranslations->get(['id', 'key']);

        foreach ($keyTranslations as $keyTranslation) {
            $keyTranslation->translation = $keyTranslation->languages[0]->pivot->translation;
            unset($keyTranslation->id);
        }

        return $keyTranslations;
    }
}
