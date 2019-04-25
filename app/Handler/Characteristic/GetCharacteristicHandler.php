<?php
namespace App\Handler\Characteristic;

use App\Characteristic;
use App\Handler\BaseHandler;
use App\Service\UrlGenerator;

/**
 * Obtiene las caracteristicas
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class GetCharacteristicHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $characteristics = Characteristic::all();
        foreach ($characteristics as $characteristic) {
            $characteristic->fieldTranslations = $characteristic->fieldTranslations();

            if (! empty($characteristic->icon)) {
                $characteristic->icon = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $characteristic->icon)]);
            }
        }

        $fieldTranslations = (new Characteristic())->fieldTranslations();

        return [
            'res' => count($characteristics),
            'data' => compact('characteristics', 'fieldTranslations')
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
        ];
    }

}