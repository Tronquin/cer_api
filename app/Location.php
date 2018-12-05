<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'location_id',
        'type',
        'nombre',
        'minimo_noches',
        'direccion',
        'plantas',
        'total_apartamentos',
        'coordenadas',
        'total_ascensores',
        'parking',
        'restaurante',
        'terraza_comunitaria',
        'recepcion',
        'guarda_maletas',
        'knock',
        'ip_ubicacion',
        'iva_reservas',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_po',
    ];

    public function experiencias()
    {
        return $this->hasMany(Experience::class, 'ubicacion_id');
    }

    /**
     * Ubicacion::find($ubicacion_id)->extras;
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function extras()
    {
            return $this->hasMany(Extra::class, 'ubicacion_id');
    }

    public function dispensers()
    {
        return $this->hasMany('App\Dispenser');

    }
    

    public function apartamentos()
    {
        return $this->hasMany('App\Apartamento');

    }

    public function centralitas()
    {
        return $this->hasMany('App\Centralita');

    }

    public function accesos()
    {
        return $this->hasMany('App\Acceso');
    }

    public function dispositivos()
    {
        return $this->hasMany('App\Dispositivo');
    }

    public function facturas()
    {
        return $this->hasMany('App\Factura');
    }

    public function resellers()
    {
        return $this->belongsToMany('App\Reseller');
    }

    public function tipologias()
    {
        return $this->hasMany('App\Tipologia');
    }

    public function tarifas()
    {
        return $this->hasMany('App\Tarifa');

    }

    public function masters()
    {
        return $this->hasMany('App\Master');
    }

    public function promocions()
    {
        return $this->hasMany('App\Promocion');
    }

    public function politica_cancelacions()
    {
        return $this->hasMany('App\PoliticaCancelacion');
    }

    public function tarifas_otas()
    {
        return $this->hasMany('App\Tarifas_ota');

    }


    /**
     * Ubicacion::find($ubicacion_id)->extras;
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function extras()
    {
        return $this->hasMany('App\Extra');
    }



    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function importaciones()
    {
        return $this->hasMany('App\ImportacionMaster');
    }


    public function incidencias()
    {
        return $this->hasMany('App\Incidencia');
    }


    public function desayunos()
    {
        return $this->hasMany('App\Desayuno');
    }


    public function categorias()
    {
        return $this->hasMany('App\Categoria');
    }*/
}