<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Service\UploadImage;
use App\Package;

class UpdateOrCreatePackageHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $pack_erp = Package::where('tarifa_id','=',$this->params['data']['tarifa_id'])->where('type','=','erp')->first();
        $pack = Package::where('tarifa_id','=',$this->params['data']['tarifa_id'])->where('type','=','web')->first();

        if(! $pack){
            $pack = new Package();
        }

        $pack->tarifa_id = $this->params['data']['tarifa_id'];
        $pack->type = 'web';
        $pack->parent_id = $pack_erp->id;
        $pack->ubicacion_id = $this->params['data']['ubicacion_id'];
        $pack->nombre = $this->params['data']['nombre'];
        $pack->incidencia_fijo = $this->params['data']['incidencia_fijo'];
        $pack->incidencia_porcentaje = $this->params['data']['incidencia_porcentaje'];
        $pack->extra_id = $this->params['data']['extra_id'];
        $pack->activo = $this->params['data']['activo'];
        $pack->orden_calculo = $this->params['data']['orden_calculo'];

        if (isset($this->params['data']['front_image'])) {
            // Imagen
            $path = UploadImage::upload($this->params['data']['front_image'], 'packages/' . $pack->id . '/');

            $pack->front_image = $path;
        }

        if (isset($this->params['data']['icon'])) {
            // Imagen
            $path = UploadImage::upload($this->params['data']['icon'], 'packages/' . $pack->id . '/');

            $pack->icon = $path;
        }
        
        $response = $pack->save();

        $arrayTags = [];
        
        $pack->updateFieldTranslations($this->params['data']['fieldTranslations']);
       
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
            'tarifa_id' => 'required|numeric',
            'ubicacion_id' => 'required|numeric',
            "activo" => 'required|numeric',
        ];
    }
}