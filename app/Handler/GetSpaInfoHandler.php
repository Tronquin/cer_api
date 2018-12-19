<?php
namespace App\Handler;

use App\SpaInfo;

class GetSpaInfoHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $spaInfo = SpaInfo::query()->with(['spaSections'])->first();

        if (! $spaInfo) {
            $spaInfo = new SpaInfo();
            $spaInfo->photo = null;
            $spaInfo->spaSections = [];
        }

        if ($spaInfo->photo) {
            $spaInfo->photo = route('storage.image', ['image' => str_replace('/', '-', $spaInfo->photo)]);
        }
            
            $spaInfo->fieldTranslations = $spaInfo->fieldTranslations();

        foreach ($spaInfo->spaSections as $spaSection) {

            if ($spaSection->photo) {
                $spaSection->photo = route('storage.image', ['image' => str_replace('/', '-', $spaSection->photo)]);
            }

            if ($spaSection->ico) {
                $spaSection->ico = route('storage.image', ['image' => str_replace('/', '-', $spaSection->ico)]);
            }

            $spaSection->fieldTranslations = $spaSection->fieldTranslations();
        }

        $response = [
            'res' => 1,
            'msg' => 'Informacion de SPA',
            'data' => [
                compact('spaInfo')
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
        return [];
    }
}