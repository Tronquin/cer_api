<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineUbication extends Model
{
    protected $table = 'machine_ubications';

    protected $fillable = [
        'name',
        'erp_ubication'
    ];

    /**
     * Todas las maquinas con esta ubicacion configurada
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function machines()
    {
        return $this->hasMany(Machine::class, 'machine_ubication_id');
    }
}
