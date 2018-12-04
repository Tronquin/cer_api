<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $table = 'machines';

    protected $fillable = [
        'public_id',
        'description',
        'machine_ubication'
    ];

    /**
     * Todos los componentes que posee la maquina
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function components()
    {
        return $this->belongsToMany(Component::class, 'machine_component', 'machine_id', 'component_id')
            ->withPivot(['active'])
        ;
    }

    /**
     * Ubicacion configurada en esta maquina
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function machineUbication()
    {
        return $this->belongsTo(MachineUbication::class, 'machine_ubication_id');
    }
}
