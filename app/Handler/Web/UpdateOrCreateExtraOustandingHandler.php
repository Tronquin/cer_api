<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\ExtraOustanding;
use App\Service\UploadImage;

class UpdateOrCreateExtraOustandingHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $oustandingsIds = [];
        foreach($this->params['oustandings'] as $extra){

            $id = $extra['id'];

            $oustanding = ExtraOustanding::query()->findOrNew($id);
            $oustanding->location_id = $this->params['location_id'];

            if (isset($extra['photo'])) {
                // Imagen
                $path = UploadImage::upload($extra['photo'], 'extras/oustandings/');

                $oustanding->photo = $path;
            }

            if (isset($extra['icon'])) {
                // Imagen
                $path = UploadImage::upload($extra['icon'], 'extras/oustandings/icon/');

                $oustanding->icon = $path;
            }

            $data['fieldTranslations'] = $oustanding->fieldTranslations();
            $oustanding->save();
            $oustanding->photo = route('storage.image', ['image' => str_replace('/', '-', $oustanding->photo)]);
            $oustanding->icon = route('storage.image', ['image' => str_replace('/', '-', $oustanding->icon)]);
            $oustanding->updateFieldTranslations($extra['fieldTranslations']);
            $oustanding['fieldTranslations'] = $oustanding->fieldTranslations();
            $data['oustanding'][] = $oustanding;
            $oustandingsIds[] = $oustanding->id;
        }

        // Elimino todas las secciones que no llegaron de front
        ExtraOustanding::query()->where('location_id',$this->params['location_id'])->whereNotIn('id', $oustandingsIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
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
            
        ];
    }

}