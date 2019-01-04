<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $dates = ['checkin', 'checkout'];

    /**
     * Tipologia
     */
    public function typology()
    {
        return $this->belongsTo(Typology::class, 'typology_id');
    }

    /**
     * Usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Experiencia
     */
    public function experience()
    {
        return $this->belongsTo(Experience::class, 'experience_id');
    }

    /**
     * Regimen
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'regimen_id');
    }

    /**
     * cancelation_policy
     */
    public function cancelation_policy()
    {
        return $this->belongsTo(CancellationPolicy::class, 'policy_id');
    }

    /**
     * promotion
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    /**
     * Apartment
     */
    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }
}
