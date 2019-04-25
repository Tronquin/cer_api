<?php
namespace App\Handler;

use App\Service\UrlGenerator;
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
            $spaInfo->spa_sections = [];
        }

        if ($spaInfo->photo) {
            $spaInfo->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaInfo->photo)]);
        }
            
        $spaInfo->fieldTranslations = $spaInfo->fieldTranslations();

        foreach ($spaInfo->spaSections as $spaSection) {

            if ($spaSection->photo) {
                $spaSection->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaSection->photo)]);
            }

            if ($spaSection->ico) {
                $spaSection->ico = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaSection->ico)]);
            }

            $spaSection->fieldTranslations = $spaSection->fieldTranslations();

            foreach($spaSection->icons as $icon){
                if ($icon->ico) {
                    $icon->ico = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $icon->ico)]);
                }
                $icon->fieldTranslations = $icon->fieldTranslations();
            }
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