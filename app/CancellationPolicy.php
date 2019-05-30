<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TraitDefinition\FieldTranslationTrait;

class CancellationPolicy extends Model
{
    use FieldTranslationTrait;
    protected $table = 'cancellation_policys';

    protected $fillable = [
        'politica_cancelacion_id',
        'type',
        'parent_id',
        'ubicacion_id',
        'nombre',
        'nombre_cliente',
        'incidencia_porcentaje',
        'activo',
    ];

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
        return ['alt_icon','alt_front_image','nombre','nombre_cliente'];
    }

}