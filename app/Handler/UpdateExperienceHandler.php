<?php
namespace App\Handler;

use App\Experience;
use App\Location;
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
        $location = Location::where('ubicacion_id', $this->params['ubicacion_id'])->firstOrFail();
        $experience = Experience::where('experiencia_id', $this->params['experienceId'])->with(['extras', 'extras_experiences_not_included'])->firstOrFail();
        foreach ($this->params['extras']['disponibles'] as $extra) {
            foreach ($experience->extras as $extraErp) {
                if ($extra['extra_id'] === $extraErp->extra_id) {

                    $extraExp = $experience->extras()->find($extraErp->id);

                    $extraExp->pivot->is_published = (bool)$extra['activo'];
                    $extraExp->pivot->save();
                }
            }
        }

        //Gathers the Ids of all extras that are included 
        $extraIdsNotAvailable = [];
        foreach ($this->params['extras']['no_disponibles'] as $extra) {
            if ($extra['activo']) {
                $extraIdsNotAvailable[] = $extra['id'];
            }
        }

        //Relacion Muchos a Muchos Experiences_Extras NOT INCLUDED 
        $experience->extras_experiences_not_included()->sync($extraIdsNotAvailable);

        $front_image_name = $location->pais . '_' . $location->ciudad . '_experience_img_' . $this->params['nombre'] . '_';
        $icon = $location->pais . '_' . $location->ciudad . '_experience_icon_' . $this->params['nombre'] . '_';

        if (isset($this->params['front_page'])) {
            // Imagen
            $path = UploadImage::upload($this->params['front_page'], 'experiences/' . $experience->id . '/', $front_image_name);
            $experience->front_page = $path;
        }

        $experience->color = $this->params['color'];

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
