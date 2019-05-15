<?php
namespace App\Handler;
use App\DeviceType;
use App\Language;
use App\Service\UrlGenerator;
use Illuminate\Support\Facades\Storage;

/**
 * Obtiene todos los idiomas disponibles con sus
 * traducciones
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class ListTranslationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $deviceType = DeviceType::query()->where('code', $this->params['device'])->first();

        if (! $deviceType) {
            throw new \Exception('Device not found');
        }

        $languages = Language::query()
            ->where('status', Language::STATUS_ACTIVE)
            ->get();

        $response = [];
        foreach ($languages as $lang) {

            $temp = [
                'name' => $lang->name,
                'iso' => $lang->iso,
                'flag' => UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $lang->flag)]),
                'translations' => []
            ];

            $keyTranslations =  $lang->keyTranslations()->where('device_type_id', $deviceType->id)->get();
            $data = '';
            foreach ($keyTranslations as $keyTranslation) {
                $temp['translations'][] = [
                    'key' => $keyTranslation->key,
                    'value' => $keyTranslation->pivot->translation
                ];
                $trans = '"'.$keyTranslation->key.'" => "'.$keyTranslation->pivot->translation.'",';
                
                $data = $data.'
                '.$trans;
                
            }

            $response[] = $temp;

            /** CREAMOS LOS ARCHIVO LANG */
            $directorio = env('APP_URL').'/resources/lang/'.$lang->iso; 
            /*//dump(file_exists($directorio),$lang->iso,$directorio);
            if(file_exists($directorio))
            {
                $mensaje = "El Directorio $directorio se ha modificado";
                dump($mensaje);
            }
            else
            {
                $content = "<?php \n\nreturn[ \n$data\n];";

                $mensaje = "El Directorio $directorio se ha creado";
                Storage::disk('languages')->put('lang/'.$lang->iso.'/emails.php', $content);
                //dump(Storage::disk('local'),Storage::disk('local')->put($directorio, $mensaje));
            }*/
        }

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
            'device' => 'required'
        ];
    }

}