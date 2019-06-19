<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\CancellationPolicy;
use App\Service\UrlGenerator;

class FindCancellationPolicyHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $cancellation_policys = [];

        $cancellationPolicyCollection = CancellationPolicy::where('ubicacion_id', $this->params['ubicacion_id'])
            ->where('type', 'erp')
            ->with(['child'])
            ->get();

            foreach ($cancellationPolicyCollection as $canpoErp) {
                
                $webOrErp = $canpoErp->child ? $canpoErp->child->toArray() : $canpoErp->toArray();
                $cancellation_policys[] = $webOrErp;
            }

            foreach ($cancellation_policys as &$cancellation_policy) {
                $cancellation_policy['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $cancellation_policy['icon'])]);
                $cancellation_policy['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $cancellation_policy['front_image'])]);
            }

        $response['res'] = count($cancellation_policys);
        $response['msg'] = 'packages de la ubicacion: '.$this->params['ubicacion_id'];
        $response['data'] = $cancellation_policys;
       
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