<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [

    ];

    public function gallery()
    {
        return $this->belongsTo(Galery::class, 'gallery_id');
    }

}