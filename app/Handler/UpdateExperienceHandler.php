<?php
namespace App\Handler;

use App\Experience;
use App\Service\UploadImage;

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

        if (isset($this->params['front_page'])) {
            // Imagen
            $path = UploadImage::upload($this->params['front_page'], 'experiences/' . $experience->id . '/');

            $experience->front_page = $path;
        }

        $experience->updateFieldTranslations($this->params['fieldTranslations']);

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
            'fieldTranslations' => 'required'
        ];
    }
}