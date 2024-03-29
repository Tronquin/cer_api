<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class Location extends Model
{
    use FieldTranslationTrait;
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
        'front_page',
        'domain',
        'default_experience',
        'pais',
        'ciudad',
        'link_tour',
        'has_spa',
        'is_published',
        'domain_logo',
        'logo',
        'marker'
    ];

    public function experiencias()
    {
        return $this->hasMany(Experience::class, 'ubicacion_id');
    }

    public function galeries()
    {
        return $this->hasMany(Galery::class, 'ubicacion_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    public function tarifas()
    {
        return $this->hasMany(Package::class, 'tarifa_id', 'tarifa_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function frequentQuestions()
    {
        return $this->belongsToMany(FrequentQuestion::class,
            'frequent_question_location',
            'location_id',
            'frequent_question_id'
        );
    }

    /**
     * Historial de busqueda para esta ubicacion
     */
    public function searchHistory()
    {
        return $this->hasMany(SearchHistory::class, 'location_id');
    }

    public function extras()
    {
        return $this->hasMany(Extra::class, 'ubicacion_id');
    }

    public function tipologias()
    {
        return $this->hasMany(Typology::class,'ubicacion_id');
    }

    public function spas()
    {
        return $this->hasMany(SpaInfo::class,'location_id');
    }

    public function promocions()
    {
        return $this->hasMany(Promotion::class,'ubicacion_id');
    }

    public function politica_cancelacions()
    {
        return $this->hasMany(CancellationPolicy::class,'ubicacion_id');
    }

    /*public function dispensers()
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



    public function masters()
    {
        return $this->hasMany('App\Master');
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
    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description_home','description','description_info',
                'title_info','title_photos_and_more','text_buscador','text_info','alt_image',
                'alt_logo','apartment_section_name'];
    }
}
