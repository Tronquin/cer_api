<?php
namespace App;

use App\TraitDefinition\FieldTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class ReasonsInfo extends Model
{
    use FieldTranslationTrait;

    protected $table = 'reasons_info';

    protected $fillable = [
        'location_id',
        'main_photo',
        'description_photo',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class);
    }

    /**
     * Campos que se pueden almacenar en field_translations
     *
     * @return array
     */
    public function fieldsToTranslate()
    {
        return ['description','floating_title','main_title','alt_photo','alt_description_photo'];
    }
}