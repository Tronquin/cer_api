<?php
namespace App\Handler;

use App\Experience;
use Illuminate\Support\Facades\Storage;

class UpdateExperienceHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $experience = Experience::where('experiencia_id', $this->params['experienceId'])->firstOrFail();

        if (isset($this->params['front_page'])) {
            // Imagen
            $path = $this->uploadImage($this->params['front_page'], 'experiences/' . $experience->id . '/');

            $experience->front_page = 'storage/' . $path;
        }

        $experience->description = $this->params['description'];
        $experience->save();

        $response = [
            'res' => 1,
            'msg' => 'Experiencia actualizada',
            'data' => [
                compact('experience')
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
        return [
            'experienceId' => 'required|numeric',
            'description' => 'required'
        ];
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
}