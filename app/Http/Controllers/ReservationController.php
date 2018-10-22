<?php

namespace App\Http\Controllers;

use App\Handler\AddReservationServiceHandler;
use App\Handler\BaksheeshHandler;
use App\Handler\CheckoutHandler;
use App\Handler\GalleryHandler;
use App\Handler\ReservationCheckinHandler;
use App\Handler\FindReservationToCheckinHandler;
use App\Handler\FindReservationHandler;
use App\Handler\FindReservationByIdHandler;
use App\Handler\AvailabilityRoomHandler;
use App\Handler\AvailabilityPlanHandler;
use App\Handler\AvailabilityExperienceHandler;
use App\Handler\AvailabilityServiceHandler;
use App\Handler\ReservationPaymentHandler;
use App\Handler\ReservationPersistenceHandler;
use App\Handler\ReservationGuestPersistenceHandler;
use App\Handler\ReservationPaymentPersistenceHandler;
use App\Handler\ReservationFindPersistenceHandler;
use App\Handler\ReservationFindGuestPersistenceHandler;
use App\Handler\ReservationServicePersistenceHandler;
use App\Handler\ScanGuestPassportHandler;
use App\Handler\UndeliveredKeyHandler;
use App\Handler\UpdateGuestPassportHandler;
use App\Handler\DeletePersistenceHandler;
use App\Handler\GenerateRateHandler;
use App\Handler\EarlyAndLateCheckinHandler;
use App\Handler\OneServicePersistenceHandler;
use App\Handler\ApartmentDisponibilityHandler;
use App\Handler\ReservationFeedbackHandler;
use App\Handler\ReservationKeyReceivedHandler;
use App\Handler\KeyDeliveredHandler;
use App\Handler\ReservationEditMailHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Handler\FindReservationByKeyHandler;

class ReservationController extends Controller
{

    /**
     * Busca todas las reservas por ubicacion_id y fecha
     *
     * @param $id
     * @param $date
     * @return JsonResponse
     */
    public function findReservationToCheckin($id,$date)
    {
        $handler = new FindReservationToCheckinHandler(['ubicacion_id' => $id,'date' => $date]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Realiza el checkin de una reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function reservationCheckin($id)
    {
        $handler = new ReservationCheckinHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por localizador o apellido
     *
     * @param $numberCodeOrName
     * @param $ubicacion_id
     * @return JsonResponse
     */
    public function findReservation($numberCodeOrName,$ubicacion_id)
    {
        $handler = new FindReservationHandler(['numberCodeOrName' => $numberCodeOrName,'ubicacion_id' => $ubicacion_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
             return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por id
     *
     * @param $id
     * @return JsonResponse
     */
    public function findReservationById($id)
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $id,'method' => 1]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $response = $handler->getData();
            $handler = new ReservationFindPersistenceHandler(['reserva_id' => $id]);
            $handler->processHandler();
            if ($handler->isSuccess()) {
                $reservaUpdate = $handler->getData();
                $response['data']['list']['reservaUpdate'] = $reservaUpdate['data']['list'];
            }
            $handler = new ReservationFindGuestPersistenceHandler(['reserva_id' => $id]);
            $handler->processHandler();
            if ($handler->isSuccess()) {
                $guestUpdate = $handler->getData();
                $response['data']['list']['guestUpdate'] = $guestUpdate['data']['list'];
            }
            return new JsonResponse($response);
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca una reserva por id por post
     *
     * @param $id
     * @return JsonResponse
     */
    public function reservationFindById($id)
    {
        $handler = new FindReservationByIdHandler(['reserva_id' => $id,'method' => 1]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de las habitaciones disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityRoom($id)
    {
        $handler = new AvailabilityRoomHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de los planes disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityPlan($id)
    {
        $handler = new AvailabilityPlanHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de las experiencias disponibles para la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function availabilityExperience($id)
    {
        $handler = new AvailabilityExperienceHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Busca los datos de los servicios disponibles para la reserva
     *
     * @param $id
     * @param $funcion
     * @return JsonResponse
     */
    public function availabilityService($id,$funcion)
    {
        $handler = new AvailabilityServiceHandler(['reserva_id' => $id,'funcion' => $funcion]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Modifica la reserva segun tipo
     * Recibe el parametro id de la reserva y dos parametros por request un string que indica el type
     * y un array que contiene los cambios a modificar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationPersistence(Request $request)
    {
        $handler = new ReservationPersistenceHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
        return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene los datos modificados de la reserva
     *
     * @param $id
     * @return JsonResponse
     */
    public function reservationFindPersistence($id)
    {
        $handler = new ReservationFindPersistenceHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda los datos de los huespedes en cer-api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationGuestPersistence(Request $request)
    {
        $handler = new ReservationGuestPersistenceHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * envia la imagen del passaporte al erp y devuelve los datos decifrados
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function scanGuestPassport(Request $request)
    {
        $handler = new ScanGuestPassportHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $data = $handler->getData();
            $guest['reserva_id'] = $data['data']['reserva_id'];
            $guest['huesped'] = [];
            array_push($guest['huesped'],$data['data']);

            $handler = new ReservationGuestPersistenceHandler(['data' => $guest]);
            $handler->processHandler();

            return new JsonResponse($data);
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Actualiza los datos de un passport/guest
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateGuestPassaport(Request $request)
    {
        $request = $request->all();
        $handler = new UpdateGuestPassportHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $data = $handler->getData();

            $guest['reserva_id'] = $request['huesped'][0]['reserva_id'];
            $guest['huesped'] = [];
            foreach ($request['huesped'] as $huesped){
                array_push($guest['huesped'],$huesped);
            }

            $handler = new ReservationGuestPersistenceHandler(['data' => $guest]);
            $handler->processHandler();

            return new JsonResponse($data);
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Pago de la reserva para hacer el checkin
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationPayment(Request $request)
    {
        $request = $request->all();
        $handler = new ReservationPaymentPersistenceHandler(['data' => $request]);
        $handler->processHandler();

        if (! $handler->isSuccess()) {
            \Log::error('Error al persistir los datos del pago',$handler->getErrors());
            \Log::error('data:',$request);

            return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
        }

        \Log::info('Persistencia de pago guardada con exito.');
        if($request['extras'] != null){
            $handler = new AddReservationServiceHandler(['data' => $request]);
            $handler->processHandler();

            if (! $handler->isSuccess()) {
                \Log::info('Error al agregar los extras',$handler->getErrors());

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            }

            \Log::info('Extras agregados con exito.');
        }
        $handler = new ReservationPaymentHandler(['data' => $request]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            $res = $handler->getData();

            $handler = new DeletePersistenceHandler(['reserva_id' => $request['reserva_id'],'status_id' => 2]);
            $handler->processHandler();
            if (! $handler->isSuccess()) {
                \Log::info('Error al agregar los extras',$handler->getErrors());

                return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
            }
            \Log::info('Reserva modificada con exito.');

            return new JsonResponse($res);
        }

        \Log::info('Error guardar los datos modificados',$handler->getErrors());

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * elimina la peristencia de datos de una reserva
     *
     * @param $id
     * @param $status
     * @return JsonResponse
     */
    public function persistenceStatusChange($id,$status){

        $handler = new DeletePersistenceHandler(['reserva_id' => $id,'status_id' => $status]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * genera las tasas de la reserva
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generateRate(Request $request){

        $handler = new GenerateRateHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * early and lated checkin
     *
     * @param $id
     * @return JsonResponse
     */
    public function earlyAndLateCheckin($id){

        $handler = new EarlyAndLateCheckinHandler(['reserva_id' => $id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda la persistencia de los servicios
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationServicePersistence(Request $request){

        $handler = new ReservationServicePersistenceHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * persiste un servicio especifico
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function oneServicePeristence(Request $request){

        $handler = new OneServicePersistenceHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * disponibilidad de un apartamento
     *
     * @param $apartamento_id
     * @param $reserva_id
     * @param $tipologia_id
     * @return JsonResponse
     */
    public function apartmentDisponibility($reserva_id,$apartamento_id,$tipologia_id){

        $handler = new ApartmentDisponibilityHandler(['reserva_id' => $reserva_id,'apartamento_id' => $apartamento_id,'tipologia_id' => $tipologia_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda el numero de llaves entregadas a la reserva
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function keysDelivered(Request $request){

        $handler = new KeyDeliveredHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * guarda el feedback de una reserva
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reservationFeedback(Request $request){

        $handler = new ReservationFeedbackHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * llaves recibidas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function KeyReceived(Request $request){

        $handler = new ReservationKeyReceivedHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * editar email del cliente
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function editMail(Request $request){

        $handler = new ReservationEditMailHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene extra llave no entregada
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function undeliveredKey($reserva_id){

        $handler = new UndeliveredKeyHandler(['reserva_id' => $reserva_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene extra para propina
     *
     * @param $reservationId
     * @return JsonResponse
     */
    public function baksheesh($reservationId){

        $handler = new BaksheeshHandler(['reserva_id' => $reservationId]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Hace checkout de una reserva
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkout(Request $request){

        $handler = new CheckoutHandler(['data' => $request->all()]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtener reserva por codigo de llave
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findReservationByKey($key){

        $handler = new FindReservationByKeyHandler(['key' => $key]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * Obtiene la galeria por el ID
     *
     * @param $galleryId
     * @return JsonResponse
     */
    public function getGallery($galleryId){

        $handler = new GalleryHandler(compact('galleryId'));
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}
