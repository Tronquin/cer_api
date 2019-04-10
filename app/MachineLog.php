<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineLog extends Model
{
    protected $fillable = [
        'machine_id',
        'content'
    ];

    /**
     * Maquina
     */
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
}
