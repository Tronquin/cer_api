<?php

namespace App\Imports;

use App\KeyTranslation;
use Maatwebsite\Excel\Concerns\ToModel;

class KeyTranslationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new KeyTranslation([

        ]);
    }
}
