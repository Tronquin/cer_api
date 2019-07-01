<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Extra;
use App\Service\ERPService;
use App\Service\UrlGenerator;

class FindExtrasContratadosHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $dataService = [
            'reserva_id' => $this->params['reserva_id'],
        ];
        $response = ERPService::extrasContratados($dataService);
        
        $extrasContratados = [];
        foreach ($response['data'] as $extERP){
            $contratado = Extra::where('extra_id',$extERP['id'])
                                    ->where('type','erp')
                                    ->with(['child'])
                                    ->firts();

            $webOrErp = $contratado->child ? $contratado->child->toArray() : $contratado->toArray();
            $webOrErp['icon'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['icon'])]);
            $webOrErp['front_image'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_image'])]);
            $webOrErp['precio'] = Extra::calcularIva($webOrErp['base_imponible'],$webOrErp['iva_tipo']);
            $webOrErp['cantidad'] = $webOrErp['cantidad'];

            $extrasContratados[] = $webOrErp;
        }

        $response = [];
        $response['res'] = count($extrasContratados);
        $response['msg'] = 'extras contratados';
        $response['data'] = $extrasContratados;
       
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
            'reserva_id' => 'required|numeric',
        ];
    }

}