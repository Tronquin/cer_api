<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\ExtraOustanding;
use App\Service\UploadImage;
use App\Document;
use App\Location;
use App\Service\UploadDocument;
use App\Service\UrlGenerator;

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
        foreach ($this->params['oustandings'] as $extra) {
            $id = $extra['id'];

            $location = Location::where('id',$this->params['location_id'])->firstOrFail();
            $oustanding = ExtraOustanding::query()->findOrNew($id);
            $oustanding->location_id = $this->params['location_id'];

            $oustandings_Name = '';
            foreach($extra['fieldTranslations'] as $iso){
                if($iso['iso'] === 'en'){
                    foreach($iso['fields'] as $oustandingsName){
                        if($oustandingsName['field'] === 'name')
                        $oustandings_Name = $oustandingsName['translation'];
                    }
                }
            }

            $front_image_name = $location->pais.'_'.$location->ciudad.'_oustandings_img_'.$oustandings_Name.'_';
            $icon = $location->pais.'_'.$location->ciudad.'_oustandings_icon_'.$oustandings_Name.'_';

            if (isset($extra['photo'])) {
                // Imagen
                $path = UploadImage::upload($extra['photo'], 'extras/oustandings/',$front_image_name);

                $oustanding->photo = $path;
            }

            if (isset($extra['icon'])) {
                // Imagen
                $path = UploadImage::upload($extra['icon'], 'extras/oustandings/icon/',$icon);

                $oustanding->icon = $path;
            }

            if (isset($extra['document'])) {
                $path = UploadDocument::upload($extra['document'], 'extras/oustandings/document/');

                $oustanding->document = $path;
            }

            if (isset($extra['documentName'])) {
                $documentName = $extra['documentName'];

                $oustanding->document_name = $documentName;
            }

            $data['fieldTranslations'] = $oustanding->fieldTranslations();
            $oustanding->save();
            $oustanding->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $oustanding->photo)]);
            $oustanding->icon = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $oustanding->icon)]);
            $oustanding->document = UrlGenerator::generate('storage.document', ['document' => str_replace('/', '-', $oustanding->document)]);
            $oustanding->updateFieldTranslations($extra['fieldTranslations']);
            $oustanding['fieldTranslations'] = $oustanding->fieldTranslations();
            $data['oustanding'][] = $oustanding;
            $oustandingsIds[] = $oustanding->id;
        }

        // Elimino todas las secciones que no llegaron de front
        ExtraOustanding::query()->where('location_id', $this->params['location_id'])->whereNotIn('id', $oustandingsIds)->delete();
            
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
