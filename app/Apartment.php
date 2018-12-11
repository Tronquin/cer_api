<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table = 'apartments';

    protected $fillable = [
        'apartamento_id',
        'type',
        'parent_id',
        'nombre',
        'tipologia_id',
        'status',
        'ubicacion_id',
        'planta',
        'puerta',
        'acceso_id',
        'altura',
        'area',
        'orientacion',
        'galeria_id',
        'pass_emergencia',
    ];

    public function experiencias()
    {
        return $this->belongsToMany(Experience::class,'experiences_apartments','apartment_id','experience_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    public function tipologia(){
        return $this->belongsTo(Typology::class,'tipologia_id','tipologia_id');
    }

    /*public function reservas()
    {
        return $this->hasMany('App\Reserva');

    }

    public function habitacions()
    {
        return $this->hasMany('App\Habitacion');

    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Ubicacion');
    }

    public function acceso()
    {
        return $this->belongsTo('App\Acceso');
    }

    public function galeria(){
        return $this->belongsTo('App\Galeria');
    }



    public function fondos()
    {
        return $this->hasMany('App\Fondo');

    }*/
}
