<?php
namespace App\Characteristict\Handler;

use App\Characteristic;
use App\Handler\BaseHandler;
use App\Service\UploadImage;
use Illuminate\Support\Facades\DB;

/**
 * Guarda las caracteristicas
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class SaveCharacteristicHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        DB::beginTransaction();

        $characteristic = new Characteristic();
        $characteristic->icon = '';
        $characteristic->updateFieldTranslations($this->params['fieldTranslations']);
        $characteristic->save();

        $path = UploadImage::upload($this->params['icon'], 'characteristics/' . $characteristic->id . '/');

        $characteristic->icon = $path;
        $characteristic->save();

        DB::commit();

        return [
            'res' => 1,
            'data' => $characteristic
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
            'icon' => 'required'
        ];
    }

}