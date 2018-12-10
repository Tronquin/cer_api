<?php
namespace App\Handler;

use App\Location;
use Illuminate\Support\Facades\Storage;

class UpdateLocationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $location = Location::where('ubicacion_id', $this->params['locationId'])->firstOrFail();

        if (isset($this->params['front_page'])) {
            // Imagen de portada
            $path = $this->uploadImage($this->params['front_page'], 'locations/' . $location->id . '/');

            $location->front_page = $path;
        }

        if (isset($this->params['logo'])) {
            // Logo
            $path = $this->uploadImage($this->params['logo'], 'locations/' . $location->id . '/');

            $location->logo = $path;
        }

        $location->description = $this->params['description'];
        $location->save();

        $response = [
            'res' => 1,
            'msg' => 'Location actualizado',
            'data' => [
                compact('location')
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
            'locationId' => 'required|numeric',
            'description' => 'required',
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