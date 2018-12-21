<?php
namespace App\Handler\Web;

use App\User;
use App\Handler\BaseHandler;

class UpdateCardInfoHandler extends BaseHandler
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
            $cardInfo->name = $this->params['name'];
            $cardInfo->description = $this->params['description'];
            $cardInfo->front_image = '';
            $cardInfo->active = 0;
            if (isset($this->params['front_image'])) {
                // Imagen
                $path = $this->uploadImage($this->params['front_image'], 'cardinfo/' . $cardInfo->id . '/');
                $cardInfo->front_page = $path;
            }
        }else{
            $cardInfo = new CardInfo();
            $cardInfo->name = $this->params['name'];
            $cardInfo->description = $this->params['description'];
            $cardInfo->front_image = '';
            $cardInfo->active = 0;
            if (isset($this->params['front_image'])) {
                $path = $this->uploadImage($this->params['front_image'], 'cardinfo/' . $cardInfo->id . '/');
                $cardInfo->front_page = $path;
            }
        }
        $cardInfo->save();
        
        $response = [
            'res' => 1,
            'msg' => "Operación exitosa",
            'data' => $cardInfo,
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
            'user_id' => 'required|numeric',
            'name' => 'required',
            //'last_name' => 'required',
            'email' => 'required',
            /*'gender' => 'required',
            'pais' => 'required|numeric',
            'ciudad' => 'required|numeric',
            'postal_code' => 'required',
            'phone' => 'required',
            'direccion' => 'required',
            'birthday' => 'required',*/
        ];
    }

}