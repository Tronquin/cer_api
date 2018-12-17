<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ERPImage extends Model
{
    protected $table = 'erp_images';

    protected $fillable = [
        'erp_photo_id',
        'url'
    ];
}
