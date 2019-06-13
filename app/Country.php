<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'phone_code'
    ];

    /**
     * Users
     */
    public function users()
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
