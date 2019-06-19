<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\CardInfo;
use App\Service\UploadImage;
use App\Service\UrlGenerator;

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

            $card_Name = '';
            foreach($card['fieldTranslations'] as $iso){
                if($iso['iso'] === 'en'){
                    foreach($iso['fields'] as $cardName){
                        if($cardName['field'] === 'name')
                        $card_Name = $cardName['translation'];
                    }
                }
            }

            $front_image_name = 'cardinfo_img_'.$card_Name.'_';

            if (isset($card['front_image'])) {
                // Imagen
                $path = UploadImage::upload($card['front_image'], 'cardinfo/',$front_image_name);

                $cardInfo->front_image = $path;
            }

            $data['fieldTranslations'] = $cardInfo->fieldTranslations;
            $cardInfo->save();
            $cardInfo->front_image = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $cardInfo->front_image)]);
            $cardInfo->updateFieldTranslations($card['fieldTranslations']);
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