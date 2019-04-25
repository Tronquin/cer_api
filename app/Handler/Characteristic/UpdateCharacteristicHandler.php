<?php
namespace App\Characteristict\Handler;

use App\Characteristic;
use App\Handler\BaseHandler;
use App\Service\UploadImage;
use Illuminate\Support\Facades\DB;

/**
 * Actualiza las caracteristicas
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class UpdateCharacteristicHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        DB::beginTransaction();

        $characteristic = Characteristic::query()->findOrFail($this->params['id']);
        $characteristic->updateFieldTranslations($this->params['fieldTranslations']);
        $characteristic->save();

        $icon = 'characteristics_icon_';

        if (isset($this->params['icon'])) {

            $path = UploadImage::upload($this->params['icon'], 'characteristics/' . $characteristic->id . '/',$icon);
            $characteristic->icon = $path;
            $characteristic->save();
        }

        DB::commit();
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