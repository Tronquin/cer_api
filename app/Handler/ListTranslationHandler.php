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
            $do_it = 0;
            foreach ($keyTranslations as $keyTranslation) {
                $temp['translations'][] = [
                    'key' => $keyTranslation->key,
                    'value' => $keyTranslation->pivot->translation
                ];
                $key_email = explode('emails',$keyTranslation->key);
                $traduccion = $keyTranslation->pivot->translation;
                if(count($key_email) > 1){
                    $key = $keyTranslation->key;
                    $limpiar_traduccion = explode('"',$keyTranslation->pivot->translation);
                    $traduccion = count($limpiar_traduccion);
                    
                    if($traduccion%2 ===0){
                        $traduccion = $keyTranslation->pivot->translation.'"';
                    }else{
                        $traduccion = $keyTranslation->pivot->translation;
                    }

                    $traduccion = $keyTranslation->pivot->translation;
                    $trans = '"'.$keyTranslation->key.'" => "'.$traduccion.'",';
                    
                    $data = $data.'
                    '.$trans;

                    $do_it = 1;
                }
            }

            $response[] = $temp;

            /** CREAMOS LOS ARCHIVO LANG */
            if($do_it === 1){
                $path = public_path();
                $directorio = explode('/public',$path);
                
                $directorio = $directorio[0].'/resources/lang/'.$lang->iso; 
                $file = $directorio.'/emails.php'; 
                $content = "<?php \n\nreturn[ \n$data\n];";

                if(file_exists($directorio))
                {
                    $mensaje = "El Directorio $directorio se ha modificado";
                    unlink($file);
                    if($archivo = fopen($file, "a"))
                    {
                        if(fwrite($archivo,$content))
                        {
                            echo "Se ha ejecutado correctamente";
                        }
                        else
                        {
                            echo "Ha habido un problema al crear el archivo";
                        }
                
                        fclose($archivo);
                    }
                }
                else
                {

                    mkdir($path.'../../resources/lang/'.$lang->iso,0777,true);
                    if($archivo = fopen($file, "a"))
                    {
                        if(fwrite($archivo,$content))
                        {
                            echo "Se ha ejecutado correctamente";
                        }
                        else
                        {
                            echo "Ha habido un problema al crear el archivo";
                        }
                
                        fclose($archivo);
                    }
                }
            }
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