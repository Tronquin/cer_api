<?php

namespace App\Handler;

use App\Experience;
use App\Extra;
use App\Service\UrlGenerator;

/**
 * Obtiene los extras para cada tag
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class FindExperienceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $experiencia = Experience::query()
            ->with(['child.extras'])
            ->where('experiencia_id',$this->params['experiencia_id'])
            ->where('type','erp')
            ->first();

        $webOrErp = $experiencia->child ? $experiencia->child->toArray() : $experiencia->toArray();
        $webOrErpObject = $experiencia->child ? $experiencia->child : $experiencia;
        $webOrErp['fieldTranslations'] = $experiencia->child ? $experiencia->child->fieldTranslations() : $experiencia->fieldTranslations();
        $webOrErp['front_page'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_page'])]);

        $extrasWebOrErp = [];
        foreach($webOrErpObject->extras as &$extra){
            $extrasWebOrErp = $extra->child ? $extra->child->toArray() : $extra->toArray();
            $extrasWebOrErp['fieldTranslations'] = $extra->child ? $extra->child->fieldTranslations() : $extra->fieldTranslations();
            $extrasWebOrErp['precio'] = Extra::calcularIva($extrasWebOrErp['base_imponible'],$extrasWebOrErp['iva_tipo']);
            $extrasWebOrErp['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extrasWebOrErp['icon'])]);
            $extrasWebOrErp['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $extrasWebOrErp['front_image'])]);
            $extras[] = $extrasWebOrErp;
        }
        $webOrErp['extras'] = $extras;

        $response = $webOrErp;

        return [
            'res' => 1,
            'msg' => 'datos de la experiencia',
            'data' => $response
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
           'experiencia_id' => 'required|numeric'
        ];
    }

}