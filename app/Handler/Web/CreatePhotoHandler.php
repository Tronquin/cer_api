<?php
namespace App\Handler\Web;

use App\Galery;
use App\Handler\BaseHandler;
use App\Photo;
use App\Service\UploadImage;

class CreatePhotoHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $gallery = Galery::where('code', $this->params['data']['galleryCode'])->firstOrFail();

        $response['data'] = [];
        $photoIds = [];
        foreach ($this->params['data']['photos'] as $p) {
            if (! isset($p['id'])) {
                if ($p['isErp']) {
                    $path = $p['photo'];
                } else {
                    $path = UploadImage::upload($p['photo'], 'galleries/' . $gallery->id . '/');
                }

                $photo = new Photo();
                $photo->gallery_id = $gallery->id;
                $photo->url = $path;
                $photo->type = $p['type'] ?? null;
                // $photo->description = $p['description'];
                $photo->save();

                $response['data'][] = $photo;
                $photoIds[] = $photo->id;
            } else {
                $photo = Photo::find($p['id']);
                $photo->type = $p['type'] ?? null;
                // $photo->description = $p['description'];
                $photo->save();

                $photoIds[] = $p['id'];
            }

            if (isset($p['fieldTranslations'])) {
                $photo->updateFieldTranslations($p['fieldTranslations']);
            }
        }

        // Elimino las imagenes que no llegaron del front
        Photo::query()->where('gallery_id', $gallery->id)->whereNotIn('id', $photoIds)->delete();

        $response['res'] = '1';
        $response['msg'] = 'foto guardada exitosamente';

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
            'galleryCode' => 'required'
        ];
    }
}
