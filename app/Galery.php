<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'galeria_id',
        'type',
        'parent_id',
        'nombre',
        'nombre_en',
        'nombre_fr',
        'nombre_po',
        'tipologia_id',
    ];

    public function fotos()
    {
        return $this->hasMany(Photo::class,'galeria_id');
    }

    public function experiencia()
    {
        return $this->hasMany(Experiencia::class,'galeria_id');
    }

    public function tipologia()
    {
        return $this->belongsTo('App\Tipologia');
    }
}
