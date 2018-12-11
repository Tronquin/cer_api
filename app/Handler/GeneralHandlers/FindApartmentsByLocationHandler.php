<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Apartment;

class FindApartmentsByLocationHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];

        $apartmentsCollection = Apartment::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child'])
            ->get();

        foreach ($apartmentsCollection as $aptErp) {
            $webOrErp[] = $aptErp->child ? $aptErp->child->toArray() : $aptErp->toArray();
        }
    
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