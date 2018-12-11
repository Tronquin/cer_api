<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineComponentError extends Model
{
    protected $table = 'machine_component_errors';

    /**
     * Maquina que genero el error
     */
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    /**
     * Componente que genero el error
     */
    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }
}
