<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class ExtraOustanding extends Model
{
    use FieldTranslationTrait;

    protected $table = 'extras_outstandings';

    protected $fillable = [
        'location_id',
        'photo',
        'icon',
    ];

    
    /**
     * Extra::find(1)->ubicacion;
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }


    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description','name', 'alt_icon', 'alt_image'];
    }
}
