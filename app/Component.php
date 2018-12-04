<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';

    protected $fillable = ['name'];

    /**
     * Todas las maquina que poseen este componente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'machine_component', 'component_id', 'machine_id')
            ->withPivot(['active'])
            ;
    }
}
