<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Location;

class FindLocationsHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $locations = Location::where('type', 'erp')
            ->with(['child'])
            ->get();
        
        $LocationwebOrErp = [];
        foreach ($locations as $locationErp) {
            $LocationwebOrErp[] = $locationErp->child ? $locationErp->child->toArray() : $locationErp->toArray();
        }

        return $LocationwebOrErp;
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            
        ];
    }

}