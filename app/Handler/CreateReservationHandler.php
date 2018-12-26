<?php
namespace App\Handler;

use App\Service\ERPService;
use App\Reservation;
use App\Typology;
use App\Apartment;
use App\Experience;
use App\Package;

/**
 * Registra una reservacion en el ERP
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class CreateReservationHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        $response = ERPService::createReservation($this->params);

        $reservation = new Reservation();
        $checkin = date("Y-m-d",strtotime($response['data']['reserva']['fecha_entrada']));
        $checkout = date("Y-m-d",strtotime($response['data']['reserva']['fecha_salida']));

        $tipologia_id = Typology::where('tipologia_id',$response['data']['reserva']['tipologia_id'])
                                    ->where('type','erp')
                                    ->first()->id;

        $apartamento_id = Apartment::where('apartamento_id',$response['data']['reserva']['ventas'][0]['concepto_id'])
        ->where('type','erp')
        ->first()->id;

        $experiencia_id = Experience::where('experiencia_id',$response['data']['reserva']['experiencia_id'])
        ->where('type','erp')
        ->first()->id;

        $package_id = Package::where('tarifa_id',$response['data']['reserva']['tarifa_id'])
        ->where('type','erp')
        ->first()->id;             

        $reservation->reserva_id_erp = $response['data']['reserva']['id'];
        $reservation->localizador_erp = $response['data']['reserva']['localizador'];
        $reservation->ubicacion_id = $response['data']['reserva']['ubicacion_id'];
        $reservation->checkin = $checkin;
        $reservation->checkout = $checkout;
        $reservation->apartment_id = $apartamento_id;
        $reservation->typology_id = $tipologia_id;
        $reservation->user_id = $this->params['user_id'];
        $reservation->experience_id = $experiencia_id;
        $reservation->regimen_id = $package_id;
        $reservation->policy_id = $response['data']['reserva']['politica_cancelacion']['id'];
        $reservation->promotion_id = $response['data']['reserva']['promocion_id'];
        $reservation->adults = $response['data']['reserva']['adultos'];
        $reservation->kids = $response['data']['reserva']['ninos'];
        $reservation->amount = $response['data']['reserva']['total_reserva'];
        $reservation->save();

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
            'fecha_entrada' => 'required|date_format:Y-m-d',
            'fecha_salida' => 'required|date_format:Y-m-d',
            'tipologia_id' => 'required|numeric',
            'apartamento_id' => 'required|numeric',
            'cliente_email' => 'required|email',
            'cliente_nombre' => 'required',
            'cliente_apellido' => 'required',
            'cliente_cif' => 'required',
            'cliente_telefono' => 'required',
            'cliente_pais' => 'required|regex:/^[A-Z]{2}$/',
            'cliente_calle' => 'required',
            'cliente_numero' => 'required',
            'cliente_piso' => 'required',
            'cliente_cpostal' => 'required',
            'cliente_ciudad' => 'required',
            'experiencia_id' => 'required|numeric',
            'regimen_id' => 'required|numeric',
            'politica_id' => 'required|numeric',
            'promocion_id' => 'required|numeric',
            'adultos' => 'required|numeric',
            'ninos' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }

}