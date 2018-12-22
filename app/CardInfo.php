<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardInfo extends Model
{
    protected $table = 'card_info';

    protected $fillable = [
        'name',
        'description',
        'front_image',
        'active'
    ];

}
