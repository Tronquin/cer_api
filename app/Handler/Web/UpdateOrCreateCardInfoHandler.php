<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\CardInfo;
use Illuminate\Support\Facades\Storage;

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
        foreach($this->params['cards'] as $card){

            $id = $card['id'];

            $cardInfo = CardInfo::query()->findOrNew($id);
            $cardInfo->order = isset($card) ? $card['order'] : null;
            $cardInfo->active = isset($card['active']) ? $card['order'] : 0;

            if (isset($card['front_image'])) {
                // Imagen
                $path = $this->uploadImage($card['front_image'], 'cardinfo/');

                $cardInfo->front_image = $path;
            }

            $data['fieldTranslations'] = $cardInfo->fieldTranslations();
            $cardInfo->save();
            $cardInfo->front_image = route('storage.image', ['image' => str_replace('/', '-', $cardInfo->front_image)]);
            $data['cards'][] = $cardInfo;
            $cardInfo->updateFieldTranslations($card['fieldTranslations']);
            $sectionIds[] = $cardInfo->id;
        }

        // Elimino todas las secciones que no llegaron de front
        CardInfo::query()->whereNotIn('id', $sectionIds)->delete();
            
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $data,
        ];

        return $response;
    }

    /**
     * Carga una imagen
     *
     * @param string $base64
     * @param string $folder
     * @return string
     */
    private function uploadImage($base64, $folder)
    {
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);
        $extension = str_replace('image/png', '', $base64[0]) !== $base64[0] ? '.png' : '.jpg';
        $filename = uniqid() . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
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