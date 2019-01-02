<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\CardInfo;
use App\Service\UploadImage;

class UpdateOrCreateCardInfoHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $cardsIds = [];
        foreach($this->params['cards'] as $card){

            $id = $card['id'];

            $cardInfo = CardInfo::query()->findOrNew($id);
            $cardInfo->order = isset($card['order']) ? $card['order'] : null;
            $cardInfo->active = isset($card['active']) ? $card['active'] : 0;
            $cardInfo->url = isset($card['url']) ? $card['url'] : null;

            if (isset($card['front_image'])) {
                // Imagen
                $path = UploadImage::upload($card['front_image'], 'cardinfo/');

                $cardInfo->front_image = $path;
            }

            $data['fieldTranslations'] = $cardInfo->fieldTranslations();
            $cardInfo->save();
            $cardInfo->front_image = route('storage.image', ['image' => str_replace('/', '-', $cardInfo->front_image)]);
            $cardInfo->updateFieldTranslations($card['fieldTranslations']);
            $cardInfo['fieldTranslations'] = $cardInfo->fieldTranslations();
            $data['cards'][] = $cardInfo;
            $cardsIds[] = $cardInfo->id;
        }

        // Elimino todas las secciones que no llegaron de front
        CardInfo::query()->whereNotIn('id', $cardsIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
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
        return [
            
        ];
    }

}