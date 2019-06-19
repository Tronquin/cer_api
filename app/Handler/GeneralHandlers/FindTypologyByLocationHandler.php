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
            ->with(['characteristics','child','apartamentos','dormitorios','cocinas','lavabos','salones','terrazas'])
            ->get();
            
        $tipologias = [];    
        foreach ($tipologiaCollection as $tpErp) {
            $webOrErp = $tpErp->child ? $tpErp->child->toArray() : $tpErp->toArray();

            $aparments = [];
            foreach ($tpErp->apartamentos as $aparmentErp) {
                $aparments[] = $aparmentErp->child ? $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }
            $dormitorios = [];
            foreach ($tpErp->dormitorios as $dormitorioErp) {
                $dormitorios[] = $dormitorioErp->child ? $dormitorioErp->child->toArray() : $dormitorioErp->toArray();
            }
            $cocinas = [];
            foreach ($tpErp->cocinas as $cocinaErp) {
                $cocinas[] = $cocinaErp->child ? $cocinaErp->child->toArray() : $cocinaErp->toArray();
            }
            $lavabos = [];
            foreach ($tpErp->lavabos as $lavaboErp) {
                $lavabos[] = $lavaboErp->child ? $lavaboErp->child->toArray() : $lavaboErp->toArray();
            }
            $salones = [];
            foreach ($tpErp->salones as $salonErp) {
                $salones[] = $salonErp->child ? $salonErp->child->toArray() : $salonErp->toArray();
            }
            $terrazas = [];
            foreach ($tpErp->terrazas as $terrazaErp) {
                $terrazas[] = $terrazaErp->child ? $terrazaErp->child->toArray() : $terrazaErp->toArray();
            }
            $characteristics = [];
            foreach ($tpErp->characteristics as &$characteristic) {
                $characteristic['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $characteristic->icon)]);
                $characteristics[] = $characteristic;

            }
            $webOrErp['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_image'])]);
            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] = $aparments;
            unset($webOrErp['dormitorios']);
            $webOrErp['dormitorios'] = $dormitorios;
            unset($webOrErp['cocinas']);
            $webOrErp['cocinas'] = $cocinas;
            unset($webOrErp['lavabos']);
            $webOrErp['lavabos'] = $lavabos;
            unset($webOrErp['salones']);
            $webOrErp['salones'] = $salones;
            unset($webOrErp['terrazas']);
            $webOrErp['terrazas'] = $terrazas;
            $webOrErp['characteristics'] = $characteristics;

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