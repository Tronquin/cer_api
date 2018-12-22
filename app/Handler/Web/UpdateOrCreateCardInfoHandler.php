<?php
namespace App\Handler\Web;

use App\User;
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
        if(isset($this->params['id'])){
            $cardInfo = CardInfo::where('id',$this->params['id'])->first();
            $cardInfo->front_image = '';
            $cardInfo->order = isset($this->params['order']) ? $this->params['order'] : null;
            $cardInfo->active = isset($this->params['active']) ? $this->params['order'] : 0;
            $cardInfo->url = isset($this->params['url']) ? $this->params['url'] : null;
        }else{
            $cardInfo = new CardInfo();
            $cardInfo->front_image = '';
            $cardInfo->order = isset($this->params['order']) ? $this->params['order'] : null;
            $cardInfo->active = isset($this->params['active']) ? $this->params['order'] : 0;
            $cardInfo->url = isset($this->params['url']) ? $this->params['url'] : null;
            $cardInfo->save();
        }
        if (isset($this->params['front_image'])) {
            $path = $this->uploadImage($this->params['front_image'], 'cardinfo/' . $cardInfo->id . '/');
            $cardInfo->front_image = $path;
        }
        if (isset($this->params['fieldTranslations'])){
            $cardInfo->updateFieldTranslations($this->params['fieldTranslations']);
        }
        $cardInfo->save();

        $cardInfo->front_image = route('storage.image', ['image' => str_replace('/', '-', $cardInfo->front_image)]);
        $cardInfo['fieldTranslations'] = $cardInfo->fieldTranslations();

        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $cardInfo,
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