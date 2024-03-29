<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;

    protected $table = 'machines';

    protected $fillable = [
        'public_id',
        'description',
        'device_url',
        'phone',
        'location_id',
        'time_repose',
        'machine_ubication_id',
        'oauth2_client_id'
    ];

    /**
     * Location
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

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
     * Errores de la maquina
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function machineComponentErrors()
    {
        return $this->hasMany(MachineComponentError::class, 'machine_id');
    }

    /**
     * Logs de la maquina
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(MachineLog::class, 'machine_id');
    }

    /**
     * Cliente api asociado a la maquina
     */
    public function oAuth2Client()
    {
        return $this->belongsTo(OAuth2Client::class, 'oauth2_client_id');
    }
}
