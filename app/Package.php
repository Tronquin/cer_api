<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class Package extends Model
{
    use FieldTranslationTrait;
    protected $table = 'packages';

    protected $fillable = [
        'tarifa_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre',
        'incidencia_fijo',
        'incidencia_porcentaje',
        'extra_id',
        'activo',
        'orden_calculo',
    ];
    
    public function extras()
    {
        return $this->belongsTo(Extra::class,'extra_id','extra_id');

    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description', 'alt_logo'];
    }


}