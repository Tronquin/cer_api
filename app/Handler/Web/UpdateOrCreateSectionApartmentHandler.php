<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use App\SectionApartment;
use Illuminate\Support\Facades\Storage;

class UpdateOrCreateSectionApartmentHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $data = [];
        $sectionApartmentIds = [];
        
        foreach($this->params['sectionApartments'] as $sectionApartment){

            $id = $sectionApartment['id'];

            $section = SectionApartment::query()->findOrNew($id);
            $section->ubicacion_id = $this->params['ubicacion_id'];
            $section->order = isset($sectionApartment['order']) ? $sectionApartment['order'] : null;
            if(isset($sectionApartment['photo'])){
                $path = $this->uploadImage($sectionApartment['photo'], 'sectionApartment/');
                $section->photo =  $path;
            }

            $data['fieldTranslations'] = $section->fieldTranslations();
            $section->save();

            $section->photo = route('storage.image', ['image' => str_replace('/', '-', $section->photo)]);
            $section->updateFieldTranslations($sectionApartment['fieldTranslations']);
            $section['fieldTranslations'] = $section->fieldTranslations();
            $data['sectionApartments'][] = $section;
            $sectionApartmentIds[] = $section->id;
        }

        // Elimino todas las secciones que no llegaron de front
        SectionApartment::query()->whereNotIn('id', $sectionApartmentIds)->delete();
            
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