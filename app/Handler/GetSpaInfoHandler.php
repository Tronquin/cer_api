<?php
namespace App\Handler;

use App\Service\UrlGenerator;
use App\SpaInfo;
use App\Language;

class GetSpaInfoHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $spaInfo = SpaInfo::query()->with(['spaSections'])
            ->where('location_id',$this->params['location_id'])
            ->first();

        if (! $spaInfo) {
            $spaInfo = new SpaInfo();
            $spaInfo->photo = null;
            $spaInfo->location_id = $this->params['location_id'];
            $spaInfo->spa_sections = [];
            foreach ($spaInfo->fieldTranslations as $iso){
                foreach($iso['fields'] as &$spaInfoName){
                    if($spaInfoName['field'] === 'name'){
                        if($spaInfoName['translation'] === '' || $spaInfoName['translation'] === null)
                        $spaInfoName['translation'] = 'SPA AND GYM';
                    }
                }
            }
        }
        
        if ($spaInfo->photo) {
            $spaInfo->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaInfo->photo)]);
        }
            

        foreach ($spaInfo->spaSections as $spaSection) {

            if ($spaSection->photo) {
                $spaSection->photo = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaSection->photo)]);
            }

            if ($spaSection->ico) {
                $spaSection->ico = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $spaSection->ico)]);
            }

            foreach($spaSection->icons as $icon){
                if ($icon->ico) {
                    $icon->ico = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $icon->ico)]);
                }
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