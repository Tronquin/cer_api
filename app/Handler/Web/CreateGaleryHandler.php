<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use App\Galery;

class CreateGaleryHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $galeria = new Galery();
        
        $galeria->galeria_id = 0;
        $galeria->type = 'web';
        $galeria->parent_galleries_id = isset($this->params['data']['parent_id']) ? $this->params['data']['parent_id'] : null;
        $galeria->nombre = $this->params['data']['nombre'];
        $galeria->nombre_en = isset($this->params['data']['nombre_en']) ? $this->params['data']['nombre_en'] : null;
        $galeria->nombre_fr = isset($this->params['data']['nombre_fr']) ? $this->params['data']['nombre_fr'] : null;
        $galeria->nombre_po = isset($this->params['data']['nombre_po']) ? $this->params['data']['nombre_po'] : null;
        $galeria->ubicacion_id = $this->params['data']['ubicacion_id'];
        $galeria->tipologia_id = isset($this->params['data']['tipologia_id']) ? $this->params['data']['tipologia_id'] : null;

        $galeria->save();

        $response['res'] = '1';
        $response['msg'] = 'Galeria creada exitosamente';
        $response['data'] = $galeria;

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
            'nombre' => 'required',
            'ubicacion_id' => 'required|numeric',
        ];
    }

}