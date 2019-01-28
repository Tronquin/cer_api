<?php

namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use FieldTranslationTrait;

    protected $table = 'galleries';

    protected $fillable = [
        'code',
        'parent_id'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'gallery_id');
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

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['alt_image'];
    }


}
