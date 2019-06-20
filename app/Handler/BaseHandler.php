<?php
namespace App\Handler;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Request;
use App\Audit;
use App\OAuth2Client;
use App\Configuration;

/**
 * Clase base para todos los Handler. Esta clase se penso
 * para que cada handler solo deba implentar los metodos
 * "handle" para la logica del proceso y "validatiorRules"
 * para todas las validaciones de los parametros para ese
 * servicio
 *
 * @author Emilio Ochoa
 *
 */
abstract class BaseHandler {

    /** Codigo de respuesta HTTP */
    const HTTP_CODE_SUCCESS = 200;
    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_EXCEPTION = 500;

    /**
     * Parametros del servicio
     * @var array
     */
    protected $params;

    /**
     * Reglas de validacion
     * @var array
     */
    private $rules;

    /**
     * Errores durante el servicio
     *
     * @var array
     */
    private $errors = [];

    /**
     * Data de respuesta
     *
     * @var array
     */
    private $data = [];

    /**
     * Codigo de respuesta HTTP
     *
     * @var int
     */
    private $statusCode;

    /**
     * Cliente que llama al servicio
     *
     * @var OAuth2Client
     */
    protected $oAuth2Client;

    /**
     * Indica si hace cache de la respuesta
     */
    protected $cache = false;

    /**
     * Tiempo de expiracion del cache
     */
    protected $timeCache = 60 * 5;

    /**
     * Dispositivos que usan cache
     */
    private $devicesToCache = ['web'];

    /**
     * Proceso de este handler
     *
     * @return array
     */
    abstract protected function handle();

    /**
     * Reglas de validacion
     *
     * @return array
     */
    abstract protected function validationRules();

    /**
     * Construct
     *
     * @param array $parameters
     */
    final public function __construct(array $parameters = [])
    {
        $this->params = $parameters;
        $this->rules = $this->validationRules();
        $this->statusCode = self::HTTP_CODE_SUCCESS;
        $this->getTokenInfo();
    }

    /**
     * Inicia el handler
     */
    final public function processHandler()
    {
        if ($this->checkValidationRules()) {

            try {
                // Inicia el handler

                $cacheKey = get_called_class();
                foreach ($this->params as $i => $param) {
                    $cacheKey .= '-' . $i . '-' . $param;
                }

                if ($this->cache && in_array($this->oAuth2Client->deviceType->code, $this->devicesToCache)) {

                    if (Cache::has($cacheKey)) {
                        $this->data = Cache::get($cacheKey);
                    } else {
                        $this->data = $this->handle();
                        Cache::put($cacheKey, $this->data, $this->timeCache);
                    }

                } else {
                    $this->data = $this->handle();
                }

                $this->audit();

            } catch (\Exception $ex) {

                // Registro la excepcion en el log
                Log::critical($ex);

                // Genero la respuesta de error controlado
                $this->addError($ex->getMessage());

                // Codigo 500 en la respuesta
                $this->statusCode = self::HTTP_CODE_EXCEPTION;
            }
        }
    }

    /**
     * Indica si el proceso es correcto
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->statusCode === self::HTTP_CODE_SUCCESS;
    }

    /**
     * Obtiene la data de respuesta
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Ontiene los errores registrados durante el proceso
     *
     * @return array
     */
    public function getErrors()
    {
        return ['errors' => $this->errors];
    }

    /**
     * Retorna el codigo HTTP del proceso
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Agrega un error
     *
     * @param $error
     * @return array
     */
    protected function addError($error)
    {
        $this->statusCode = self::HTTP_CODE_BAD_REQUEST;
        $this->errors[] = $error;
    }

    /**
     * Valida los parametros del servicio
     *
     * @return bool
     */
    private function checkValidationRules()
    {
        //Validacion para metodos post (se envia en data) y get
        if(isset($this->params['data'])){
            $validator = Validator::make($this->params['data'], $this->rules);
        }else{
            $validator = Validator::make($this->params, $this->rules);
        }

        if (! $validator->passes()) {

            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $this->addError($error);
            }
        }

        if ($this->isSuccess()) {
            return true;
        }

        return false;
    }

    /**
     * Auditoria
     * 
     */
    private function audit()
    {
        $token = Request::header('token');
        $client = OAuth2Client::query()->where('token', $token)->first();
        $config = Configuration::query()->first();
        $audit = new Audit();
        $audit->ip = Request::ip();
        $audit->oauth2_client_id = $client->id;
        $audit->action = get_class($this);
        $audit->params = json_encode($this->params);
        $audit->response = json_encode($this->data);
        $audit->version = $config->version;

        $audit->save();
    }

    /**
     * Extrae informacion del token para utilizar
     * en los servicios
     */
    private function getTokenInfo()
    {
        $token = Request::header('token');
        $client = OAuth2Client::query()->where('token', $token)->with(['deviceType', 'machine'])->first();
        $this->oAuth2Client = $client;
    }
}