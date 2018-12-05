<?php
namespace App\Handler;

use App\Experience;

class UpdateExperienceHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $experience = Experience::where('experiencia_id', $this->params['experienceId'])->firstOrFail();

        $experience->description = $this->params['description'];
        $experience->save();

        $response = [
            'res' => 1,
            'msg' => 'Experiencia actualizada',
            'data' => [
                compact('experience')
            ]
        ];

        return $response;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'experienceId' => 'required|numeric',
            'description' => 'required'
        ];
    }
}