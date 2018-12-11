<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'code',
        'parent_id'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'galleries_id');
    }

    //Relacion con las Experiencias
    public function experiencia()
    {
        return $this->hasMany(Experience::class,'galeria_id','galeria_id');
    }

    //Relacion con la Ubicacion
    public function ubicacion()
    {
        return $this->belongsTo(Location::class,'id');
    }

    
    public function tipologia()
    {
        return $this->belongsTo(Typology::class,'tipologia_id','tipologia_id');
    }

    // Relacion para obtener la version web del registro erp de la galeria
    public function parentErp()
    {
        return $this->belongsTo(self::class, 'parent_galeria_id');
    }

    // Relacion para obtener la version web del registro erp de la galeria
    public function childErp()
    {
        return $this->hasOne(self::class, 'parent_galeria_id');
    }

    // Relacion para obtener las galerias padres creadas a traves del admin
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // Relacion para obtener las galerias hijos creadas a traves del admin
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
