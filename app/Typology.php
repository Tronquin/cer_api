<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    protected $table = 'typologies';

    protected $fillable = [
        'tipologia_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre_manual',
        'status',
        'max',
        'min',
        'incidencia_porcentaje',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_po',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    public function apartamentos()
    {
        return $this->hasMany(Apartment::class,'tipologia_id','tipologia_id');
    }

    public function galerias()
    {
        return $this->hasMany(Galery::class,'galeria_id','galeria_id');
    }

    public function cocinas()
    {
        return $this->hasMany('App\Cocina');
    }

    public function dormitorios()
    {
        return $this->hasMany('App\Dormitorio');
    }

    public function lavabos()
    {
        return $this->hasMany('App\Lavabo');
    }

    public function salons()
    {
        return $this->hasMany('App\Salon');
    }

    public function terrazas()
    {
        return $this->hasMany('App\Terraza');
    }

    public function ubicacion(){
        return $this->belongsTo('App\Ubicacion');
    }

}
