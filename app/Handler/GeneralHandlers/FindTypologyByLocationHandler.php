<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Typology;
use App\Service\UrlGenerator;

class FindTypologyByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];

        $tipologiaCollection = Typology::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['characteristics','child','apartamentos'])
            ->get();
            
        $tipologias = [];    
        foreach ($tipologiaCollection as $tpErp) {
            $webOrErp = $tpErp->child ? $tpErp->child->toArray() : $tpErp->toArray();

            $aparments = [];
            foreach ($tpErp->apartamentos as $aparmentErp) {
                $aparments[] = $aparmentErp->child ? $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }
            $characteristics = [];
            foreach ($tpErp->characteristics as &$characteristic) {
                $characteristic['fieldTranslations'] = $characteristic->fieldTranslations();
                $characteristic['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $characteristic->icon)]);
                $characteristics[] = $characteristic;

            }
            $webOrErp['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_image'])]);
            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] = $aparments;
            $webOrErp['characteristics'] = $characteristics;
            $webOrErp['fieldTranslations'] = $tpErp->child ? $tpErp->child->fieldTranslations() : $tpErp->fieldTranslations();
            $tipologias[] = $webOrErp;
        }

        $response['res'] = count($tipologias);
        $response['msg'] = 'Tipologias encontrados para la ubicacion '.$this->params['ubicacion_id'];
        $response['data'] = $tipologias;
        
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