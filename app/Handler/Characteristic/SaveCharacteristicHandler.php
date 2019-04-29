<?php
namespace App\Handler\Characteristic;

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
        $characteristic->save();
        $icon = 'characteristics_icon_';
        
        $path = UploadImage::upload($this->params['icon'], 'characteristics/' . $characteristic->id . '/',$icon);
        
        $characteristic->icon = $path;
        $characteristic->save();
        
        $characteristic->updateFieldTranslations($this->params['fieldTranslations']);
        
        DB::commit();
        return [
            'res' => 1,
            'msg' => 'Operación exitosa',
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