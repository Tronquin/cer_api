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
            ->with(['child'])
            ->get();

        foreach ($tipologiaCollection as $tpErp) {
            $webOrErp[] = $tpErp->child ? $tpErp->child->toArray() : $tpErp->toArray();
        }

        $response['res'] = count($webOrErp);
        $response['msg'] = 'Tipologias encontrados para la ubicacion '.$this->params['ubicacion_id'];
        $response['data'] = $webOrErp;
        
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