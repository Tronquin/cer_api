<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use FieldTranslationTrait;

    protected $table = 'extras';

    protected $fillable = [
        'extra_id',
        'type',
        'ubicacion_id',
        'nombre',
        'nombre_es',
        'nombre_en',
        'nombre_fr',
        'nombre_zh',
        'nombre_ru',
        'nombre_po',
        'descripcion_es',
        'descripcion_en',
        'descripcion_fr',
        'descripcion_zh',
        'descripcion_ru',
        'descripcion_po',
        'coste',
        'base_imponible',
        'iva_tipo',
        'manera_cobro',
        'servicio_gestion',
        'destacado',
        'activo',
        'cambia_hora_entrada',
        'cambia_hora_salida',
        'front_image',
        'icon',
        'outstanding',
        'is_published'
    ];

    /**
     * Enviamos base imponible y porcentaje de iva a cobrar y nos retorna los calculos hechos
     *
     * @param $base_imponible
     * @param $iva
     * @return array
     */
    public static function calcularIva($base_imponible,$iva){

        //        $iva = $iva/100 * round($base_imponible,2);
        //        //$total = round($iva + $base_imponible,2);
        //        $total = round($iva,2) + round($base_imponible,2);
        //        return [
        //            'base_imponible' => round($base_imponible,2),
        //            'monto_iva' => round($iva,2),
        //            'total' => round($total,2)
        //        ];
        
                $iva = $iva/100 * $base_imponible;
                //$total = round($iva + $base_imponible,2);
                $total = $iva + $base_imponible;
                return [
                    'base_imponible' => $base_imponible,
                    'monto_iva' => $iva,
                    'total' => $total
                ];
        
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experiences_extras', 'extra_id', 'experience_id')
            ->withPivot('is_published');;
    }

    /**
     * Extra::find(1)->ubicacion;
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion()
    {
        return $this->belongsTo(Location::class, 'ubicacion_id');
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
     * Tags asociados a este extra
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'extra_tag', 'extra_id', 'tag_id');
    }

    /**
     * section apartment asociados a este extra
     */
    public function sectionApartments()
    {
        return $this->belongsToMany(SectionApartment::class, 'section_apartment_extras', 'extra_id', 'section_apartment_id');
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description','nombre', 'alt_image', 'alt_icon'];
    }
}