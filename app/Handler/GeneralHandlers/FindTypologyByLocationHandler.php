<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Typology;

class FindTypologyByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];

        $tipologiaCollection = Typology::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child','apartamentos'])
            ->get();

        foreach ($tipologiaCollection as $tpErp) {
            $webOrErp = $tpErp->child ? $tpErp->child->toArray() : $tpErp->toArray();

            $aparments = [];
            foreach ($tpErp->apartamentos as $aparmentErp) {
                $aparments[] = $aparmentErp->child ? $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }

            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] = $aparments;

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