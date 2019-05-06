<?php
namespace App\Handler\PaymentGateway;

use App\Handler\BaseHandler;
use App\Service\ERPService;
use Request;

class ReservationProcessPaymentHandler extends BaseHandler{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $pago_id = [];
        foreach($this->params['data'] as $data){
            $cc = $data['creditCard'];
            $name = str_replace(' ', '_', $data['holder']);
            $date = $data['date'];
            $cvc = $data['cvc'];
    
            $ccString = "{$cc}/{$date}/{$cvc}";
            $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('$4a$'), $ccString, MCRYPT_MODE_CBC, md5(md5('$4a$'))));
    
            $response = ERPService::processPayment([
                'pago_id' => $data['paymentId'],
                'nombre' => $data['holder'],
                'nombre_apellido' => $data['holder'],
                'enc' => $ccString
            ]);
            
            $pago_id[] = $response['data']['pago_id'];
            if(!$response || ($response['res'] !== 1 && $response['res'] === -2)){
                    return $paymentfail = [
                        'res' => -1,
                        'msg' => 'error al procesar el pago',
                        'data' => $pago_id
                    ];
            }
        }
        $response['pago_ids'] = $pago_id;

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
            /*'paymentId' => 'required|numeric',
            'creditCard' => 'required',
            'holder' => 'required',
            'date' => 'required|regex:/^[0-9]{2}-[0-9]{4}$/',
            'cvc' => 'required'*/
        ];
    }

}