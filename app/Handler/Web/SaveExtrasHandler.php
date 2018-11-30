<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Extra;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaveExtrasHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $extra = Extra::where('extra_id','=',$this->params['data']['extra_id'])->where('type','=','web')->first();

        if($extra){
            $extra->type = 'web';
            $extra->nombre = $this->params['data']['nombre'];
            $extra->nombre_es = $this->params['data']['nombre_es'];
            $extra->nombre_en = $this->params['data']['nombre_en'];
            $extra->nombre_fr = $this->params['data']['nombre_fr'];
            $extra->nombre_zh = $this->params['data']['nombre_zh'];
            $extra->nombre_ru = $this->params['data']['nombre_ru'];
            $extra->nombre_po = $this->params['data']['nombre_po'];
            $extra->descripcion_es = $this->params['data']['descripcion_es'];
            $extra->descripcion_en = $this->params['data']['descripcion_en'];
            $extra->descripcion_fr = $this->params['data']['descripcion_fr'];
            $extra->descripcion_zh = $this->params['data']['descripcion_zh'];
            $extra->descripcion_ru = $this->params['data']['descripcion_ru'];
            $extra->descripcion_po = $this->params['data']['descripcion_po'];
            $extra->destacado = $this->params['data']['destacado'];
            $extra->activo = $this->params['data']['activo'];
            
        }else{
            $extra = new Extra();

            $extra->extra_id = $this->params['data']['extra_id'];
            $extra->type = 'web';
            $extra->ubicacion_id = $this->params['data']['ubicacion_id'];
            $extra->nombre = $this->params['data']['nombre'];
            $extra->nombre_es = $this->params['data']['nombre_es'];
            $extra->nombre_en = $this->params['data']['nombre_en'];
            $extra->nombre_fr = $this->params['data']['nombre_fr'];
            $extra->nombre_zh = $this->params['data']['nombre_zh'];
            $extra->nombre_ru = $this->params['data']['nombre_ru'];
            $extra->nombre_po = $this->params['data']['nombre_po'];
            $extra->descripcion_es = $this->params['data']['descripcion_es'];
            $extra->descripcion_en = $this->params['data']['descripcion_en'];
            $extra->descripcion_fr = $this->params['data']['descripcion_fr'];
            $extra->descripcion_zh = $this->params['data']['descripcion_zh'];
            $extra->descripcion_ru = $this->params['data']['descripcion_ru'];
            $extra->descripcion_po = $this->params['data']['descripcion_po'];
            $extra->coste = $this->params['data']['coste'];
            $extra->base_imponible = $this->params['data']['base_imponible'];
            $extra->iva_tipo = $this->params['data']['iva_tipo'];
            $extra->manera_cobro = $this->params['data']['manera_cobro'];
            $extra->servicio_gestion = $this->params['data']['servicio_gestion'];
            $extra->destacado = $this->params['data']['destacado'];
            $extra->activo = $this->params['data']['activo'];
        }

        $response = $extra->save();
       
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
            'extra_id' => 'required|numeric',
            'ubicacion_id' => 'required|numeric',
            'nombre' => 'required',
            "destacado" => 'required|numeric',
            "activo" => 'required|numeric',
        ];
    }

}