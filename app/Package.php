<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    protected $table = 'packages';

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



}