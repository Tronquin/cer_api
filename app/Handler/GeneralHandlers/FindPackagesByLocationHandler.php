<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Package;
use App\Service\UrlGenerator;

class FindPackagesByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $packages = [];

        $packagesCollection = Package::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child', 'extras'])
            ->get();

        foreach ($packagesCollection as $pakErp) {

            $webOrErp = $pakErp->child ? $pakErp->child->toArray() : $pakErp->toArray();

            if($pakErp->extra){
                $extras = $pakErp->extra->child ? $pakErp->extra->child->toArray() : $pakErp->extra->toArray();

                unset($webOrErp['extras']);
                $webOrErp['extras'] = $extras;
            }
            $webOrErp['fieldTranslations'] = $pakErp->child ? $pakErp->child->fieldTranslations() : $pakErp->fieldTranslations();
            $packages[] = $webOrErp;
        }

        foreach ($packages as &$package) {
            $package['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $package['icon'])]);
            $package['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $package['front_image'])]);
        }

        $response['res'] = count($packages);
        $response['msg'] = 'packages de la ubicacion: '.$this->params['ubicacion_id'];
        $response['data'] = $packages;

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
            'ubicacion_id' => 'required|numeric',
        ];
    }

}