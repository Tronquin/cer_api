<?php
namespace App\Service\PaymentTypes;

class StripePaymentService {

/**
     *  constante que define una antelación general para los PaymentGateway
     */
    const CUTOFF = 0;
    
    /**
     * indica el estado de la transacción tras un evento de pago
     */
    private $success;

    /**
     * indica la moneda de la operacion
     */
    private $currency;


    public function __construct(array $config)
    {
        $this->config = $config;

        /*
         * Tipos de estados de la transacción
         *
         *  1: 'Hubo un error de comunicación con el banco, por favor intente mas tarde'
         *  2: 'La transacción ha sido rechazada por el banco, contacte a su entidad bancaria'
         *  3: 'Hubo un error de comunicación con el banco, por favor intente mas tarde'
         *  4: 'Su tarjeta se encuentra vencida'
         *  5: 'El código de seguridad indicado es invalido, por favor verifique e intente nuevamente'         *
         */
        $this->states = [
            'success' => 'APROBADO',
            'card_error' => 3,
            'rate_limit_error' => 2,
            'invalid_request_error' => 3,
            'authentication_error' => 3,
            'api_connection_error' => 2,
            'api_error' => 2,
        ];
    }

    /**
     * Envia los datos de un pago a stripe
     * @param $request
     * @return array
     */
    public function processPayment($request)
    {
        try {
            \Stripe\Stripe::setApiKey($this->config['api_key']);
            $charge = \Stripe\Charge::create($this->formaterRequestData($request));

            return $this->formaterResponseData($charge);

        } catch(\Stripe\Error\Base $e) {

            $body = $e->getJsonBody();
            $err  = $body['error'];
            $err['status'] = $e->getHttpStatus();
            $err['amount'] = $request['amount'];
            return $this->formaterResponseErrorData($err,$request);
        }
    }

    /**
     * este metodo toma un conjunto de pagos, los valida y los procesa
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @param $request
     * @return  Object | json | array
     */
    public function processPayments($request)
    {
        $response = [];
        $this->success = true;
        foreach ($request as &$payment) {
            if ((isset($payment['date'])) && (!isset($payment['checkInDate'])))         
                $payment['checkInDate'] = $payment['date'];
            $currentResponse = $this->processPayment($payment);
            $response[] = $currentResponse;
        }
        return $response;
    }

    /**
     * debe validar que todos los campos requeridos para hacer la solicitud esten completos y sean correctos
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @return  boolean
     * @param $request
     */
    public function validateRequestData($request)
    {
        $amount = str_replace(",","",(string)$request['amount']);  //Eliminar las comas del monto a cobrar
        $amount = str_replace(".","",(string)$amount);  //Eliminar las comas del monto a cobrar

        if (empty($request['firstName']))
            throw new EntityValidationException('payments',\get_class($this),'first_name_required');
        if (empty($request['lastName']))
            throw new EntityValidationException('payments',\get_class($this),'last_name_required');
        if (empty($request['number']) || !$this->checkLuhn($request['number']))
            throw new EntityValidationException('payments',\get_class($this),'invalid_card_number');
        if(empty($request['expirationMonth']) || !is_numeric($request['expirationMonth']))
            throw new EntityValidationException('payments',\get_class($this),'invalid_month_expiration');
        if(empty($request['expirationYear']) || !is_numeric($request['expirationYear']))
            throw new EntityValidationException('payments',\get_class($this),'invalid_year_expiration');
        if(!$this->checkExpiredDate($request['expirationMonth'],$request['expirationYear']))
            throw new EntityValidationException('payments',\get_class($this),'invalid_date_expiration');
        if(empty($request['cvc']) || !is_numeric($request['cvc']) || strlen($request['cvc'])!=3)
            throw new EntityValidationException('payments',\get_class($this),'invalid_cvc');
        if(empty($request['amount']) || !is_numeric($amount))
            throw new EntityValidationException('payments',\get_class($this),'invalid_amount');
        if(empty($request['description']))
            throw new EntityValidationException('payments',\get_class($this),'invalid_description');
        if(empty($request['ip']))
            throw new EntityValidationException('payments',\get_class($this),'empty_ip');
        if(empty($request['checkInDate']) && !($request['checkInDate'] instanceof \DateTime))
            throw new EntityValidationException('payments',\get_class($this),'invalid_reservation_check_in');

        return true;
    }

    /**
     * debe devolver la data requerida para hacer la solicitud formateada segun los requerimientos de la entidad
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @param $request
     */
    public function formaterRequestData($request)
    {
        if(!preg_match('/^[0-9]+([\.][0-9]{1,2})?$/',$request['amount'],$matches)){
            throw new \Exception('Amount format error');
        }
        
        $amount = (string)($request['amount']*100);
        
        return [
            "amount" => $amount,
            "currency" => $this->currency,
            "source" => $this->formatCardData($request),
            "description" => $request['description'],
            'metadata' => [
                'clientIp' => $request['ip'],
            ],
        ];
    }

    /**
     * Da formato a los datos de la tarjeta para enviarlos en la solicitud
     * @param $request
     * @return array
     */
    public function formatCardData($request)
    {
        $name = $request['holder'];
        return [
            'name' => $name,
            'number' => $request['number'],
            'exp_month' => $request['expirationMonth'],
            'exp_year' => $request['expirationYear'],
            'cvc' => $request['cvc'],
            'object' => 'card'
        ];
    }

    /**
     * debe devolver la data requerida para ser devuelta a el caso de uso segun el formato que necesite
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @param $response
     * @return array
     */
    public function formaterResponseData($response)
    {
        $dcharge = $response->__toJSON(); // Se pasa la respuesta de la API a Json para pasarla a json_decode
        $c_data = json_decode($dcharge,true);

        return [
            'id' => $c_data['id'],
            'success' => $c_data['status'] == "succeeded",
            'code' => ($c_data['status'] == "succeeded") ? '201' : '400',
            'reference' => $c_data['id'],
            'status' => $c_data["status"] == 'succeeded' ? 1 : 2,
            'amount' => ((integer)$c_data['amount']), //devuelve el monto sin comas
            'response' => $dcharge,
            'currency' => $this->currency,
            //'dollarPrice' => 4,
            'nationalPrice' => $c_data['amount']/100,
            'responsecode' => 'success',
            'holder' => $response['source']['name'],
            'message' => 'success'
        ];
    }

    /**
     * debe devolver la data requerida para ser devuelta a el caso de uso segun el formato que necesite
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @param $response
     * @param $request
     * @return array
     */
    public function formaterResponseErrorData($response,$request)
    {
        $national = str_replace(".",",",str_replace(",","",$response['amount']));
        //$foreign = RateExteriorCalculator::calculateRateChange($national);
        //new RateExteriorCalculator($this->rf,'USD');
        //$dollar = RateExteriorCalculator::calculateRateChange($national);
        $name = $request['holder'];
        return [
            'id' => null,
            'success' => false,
            'code' => $response['status'],
            'reference' => null,
            'status' => 2,
            //'amount' => $foreign,
            'response' => json_encode($response),
            'currency' => $this->currency,
            //'dollarPrice' => $dollar,
            'nationalPrice' => $national,
            'responsecode' => $response['type'],
            'holder' => $name,
            'message' => $response['message'],
        ];
    }

    /**
     * devueleve un entero que representa el estado de la reserva segun la condicion de los pagos
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @param Reservation $reservation
     * @return string
     */
    public function getStatusReservation(Reservation $reservation)
    {
        $status = null; //default pre-reserva pendiente por pago
        $paid = false;
        $total = 0;
        foreach ($reservation->getPayments() as $payment) {
            if ($payment->getStatus() == 1)
                $total = $total + $payment->getAmount();
            $paid =  ($total >= $reservation->getCurrencyPrice());
        }
        if($paid)
            $status = 2; //confirmada
        return $status;
    }

    /**
     * indica si el pago es valido y correcto
     *
     * @author Ruben Hidalgo
     * @version 1.0
     * @return bolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Devuelve el status del la transacción
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getTypePayment()
    {
        return PaymentGateway::STRIPE_TDC;
    }

    public function getCutOff()
    {
        return self::CUTOFF;
    }

    /**
     * devuelve un array clave => valor con los estados posibles de el tipo de reservas que implementa
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * establece en que moneda se realizaran los cobros
     *
     * @param string $currency
     * @return Object
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        //$this->zeroDecimalBase = $currency->getZeroDecimalBase();
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * algoritmo que chequea que sea un numero de TDC valido
     */
    private function checkLuhn($input)
    {
        $sum = 0;
        $numdigits = strlen($input);
        $parity = $numdigits % 2;
        for($i=0; $i < $numdigits; $i++) {
            $digit = (int)substr($input, $i, 1);

            if($i % 2 == $parity)
                $digit *= 2;
            if($digit > 9)
                $digit -= 9;

            $sum += $digit;
        }

        return ($sum % 10) == 0;
    }

    private function checkExpiredDate($month,$year)
    {
        $now = new \DateTime();

        if ((int)$month < 12) {
            $month = ((int)$month) + 1;
        } else {
            $month = 1;
            $year = ((int)$year) + 1;
        }

        $date = new \DateTime($year .'-'. $month .'-01');

        return $date > $now;
    }

}

