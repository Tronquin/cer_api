<?php
namespace App\Handler\Reasons;

use App\ReasonsInfo;
use App\Reason;
use App\Handler\BaseHandler;
use App\Service\UploadImage;

class UpdateReasonsHandler extends BaseHandler {

    /**
     * Handler que actualiza el reason info
     * Proceso de este handler
     */
    protected function handle()
    {

        if(intval($this->params['location_id']) === 0) $this->params['location_id'] = null;
        
        $reasons_info = ReasonsInfo::where('location_id', $this->params['location_id'])->with('reasons')->firstOrFail();

        $reasons_info->updateFieldTranslations($this->params['fieldTranslations']);

        $image_name = UploadImage::slug('reason_info_main_img_');
        $description_image_name = UploadImage::slug('reason_info_description_img_');

        if (isset($this->params['main_photo'])) {
            // Imagen
            $path = UploadImage::upload($this->params['main_photo'], 'reasonsInfo/' . $reasons_info->id . '/', $image_name);

            $reasons_info->main_photo = $path;
        }

        if (isset($this->params['description_photo'])) {
            // Imagen
            $path = UploadImage::upload($this->params['description_photo'], 'reasonsInfo/' . $reasons_info->id . '/', $description_image_name);

            $reasons_info->description_photo = $path;
        }

        $reasons_info->save();

        $reasonsIds = [];
        foreach ($this->params['reasons'] as $reason_data) {

            $id = $reason_data['id'];

            $reason = Reason::query()->findOrNew($id);
            $reason->reasons_info_id = $reasons_info->id;
            
            $reason_image_name = UploadImage::slug('reason_photo_img_');
            $reason_description_image_name = UploadImage::slug('reason_icon_img_');

            if (isset($reason_data['photo'])) {
                // Imagen
                $path = UploadImage::upload($reason_data['photo'], 'reason/', $reason_image_name);

                $reason->photo = $path;
            }

            if (isset($reason_data['icon'])) {
                // Icon
                $path = UploadImage::upload($reason_data['icon'], 'reason/', $reason_description_image_name);

                $reason->icon = $path;
            }

            if (isset($reason_data['order'])) {
                $reason->order = $reason_data['order'];
            }

            $reason->save();
            $reason->updateFieldTranslations($reason_data['fieldTranslations']);
            $reasonsIds[] = $reason->id;
        }
        Reason::query()->where('reasons_info_id', $reasons_info->id)->whereNotIn('id', $reasonsIds)->delete();

        $response = [
            'res' => 1,
            'msg' => 'Reasons Info Actualizada !',
            'data' => [
                $reasons_info
            ]
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
        return [];
    }

}