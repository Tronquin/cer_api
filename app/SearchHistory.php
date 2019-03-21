<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $table = 'search_history';

    protected $fillable = [
        'start_date',
        'end_date',
        'location_id',
        'adults',
        'kids',
        'apartments'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    /**
     * Ubicacion
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
