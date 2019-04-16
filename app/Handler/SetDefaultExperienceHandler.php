<?php
namespace App\Handler;

use App\Location;

/**
 * Configura las experiencias predeterminadas de home
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class SetDefaultExperienceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        Location::query()->update(['default_experience' => false]);

        $location = Location::query()->where('location_id', $this->params['ubicacion_id'])->firstOrFail();
        $location->default_experience = true;
        $location->save();

        return [
            'res' => 1,
            'data' => $location
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'ubicacion_id' => 'required|numeric'
        ];
    }

}