<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use Illuminate\Support\Facades\DB;
use App\Typology;
use App\Service\UploadImage;
use App\Service\UrlGenerator;

class UpdateOrCreateTypologyHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        DB::beginTransaction();

        $location = Location::where('ubicacion_id',$this->params['ubicacion_id'])->firstOrFail();
        $tipologia = Typology::query()->findOrNew($this->params['id']);

        $front_image_name = $location->pais.'_'.$location->ciudad.'_typology_';

        if (isset($this->params['front_image'])) {
            // Imagen
            $path = UploadImage::upload($this->params['front_image'], 'typology/',$front_image_name);

            $tipologia->front_image = $path;
        }
        $tipologia->save();
        $tipologia->updateFieldTranslations($this->params['fieldTranslations']);

        $caracteristicasIds = [];
        foreach($this->params['characteristics'] as $caracteristicas){
            $caracteristicasIds[] = $caracteristicas['id'];
        }
        $tipologia->characteristics()->sync($caracteristicasIds);

        DB::commit();
        return [
            'res' => 1,
            'msg' => 'Operación exitosa',
            'data' => $tipologia
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
            'fieldTranslations' => 'required',
        ];
    }

}