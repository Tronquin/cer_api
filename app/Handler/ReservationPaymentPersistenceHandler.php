<?php
namespace App\Handler;

use App\ReservationPaymentPersistence;
use App\Service\ERPService;

class ReservationPaymentPersistenceHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $payment_persistence = new ReservationPaymentPersistence();
        $payment_persistence->reserva_id = $this->params['data']['reserva_id'];
        $payment_persistence->msg = $this->params['data']['msg'];
        $payment_persistence->numOpBco = $this->params['data']['numOpBco'];
        $payment_persistence->code = $this->params['data']['code'];
        $payment_persistence->numRefTP = $this->params['data']['numRefTP'];
        $payment_persistence->bIN = $this->params['data']['bIN'];
        $payment_persistence->numOpCO = $this->params['data']['numOpCO'];
        $payment_persistence->red = $this->params['data']['red'];
        $payment_persistence->codAut = $this->params['data']['codAut'];
        $payment_persistence->aRC = $this->params['data']['aRC'];
        $payment_persistence->tipoLectura = $this->params['data']['tipoLectura'];
        $payment_persistence->moneda = $this->params['data']['moneda'];
        $payment_persistence->tipoOp = $this->params['data']['tipoOp'];
        $payment_persistence->cVM = $this->params['data']['cVM'];
        $payment_persistence->txtBanco = $this->params['data']['txtBanco'];
        $payment_persistence->tarjeta = $this->params['data']['tarjeta(enmascarada)'];
        $payment_persistence->taxFree = $this->params['data']['taxFree'];
        $payment_persistence->ticket = $this->params['data']['ticket'];
        $payment_persistence->tipoTarjeta = $this->params['data']['tipoTarjeta'];
        $payment_persistence->terminal = $this->params['data']['terminal'];
        $payment_persistence->importe = $this->params['data']['importe'];
        $payment_persistence->fechaContable = $this->params['data']['fechaContable'];
        $payment_persistence->pais = $this->params['data']['pais'];
        $payment_persistence->idSesion = $this->params['data']['idSesion'];
        $payment_persistence->lBL = $this->params['data']['lBL'];
        $payment_persistence->comercio = $this->params['data']['comercio'];
        $payment_persistence->aID = $this->params['data']['aID'];
        $payment_persistence->txtMarca = $this->params['data']['txtMarca'];
        $payment_persistence->titular = $this->params['data']['titular'];
        $payment_persistence->emisor = $this->params['data']['emisor'];

        $response = $payment_persistence->save();

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
            'reserva_id' =>'required|numeric',
        ];
    }

}