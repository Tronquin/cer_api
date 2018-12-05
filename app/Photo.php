<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [
        'foto_id',
        'type',
        'galeria_id',
        'archivo',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_zh',
        'descripcion_ru',
        'descripcion_po',
    ];

    public function galeria()
    {
        return $this->belongsTo(Galery::class,'galeria_id');
    }

}