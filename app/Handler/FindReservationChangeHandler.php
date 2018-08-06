<?php
namespace App\Handler;


use App\Service\ERPService;

class FindReservationChangeHandler extends BaseHandler {

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response['data']=[];

            /*$dataService =[
                'reserva_id' => $this->params['data']['reserva_id'],
                'funcion' => $this->params['data']['funcion'],
            ];
            $service = ERPService::findReservationService($dataService);
            if($service['res'] > 0 && $service['data']['list']){
                $response['data']['list']['service']['extras_contratados']=$service['data']['list']['extras_contratados'];
                $response['data']['list']['service']['extras_disponibles']=$service['data']['list']['extras_disponibles'];
            }*/

            $dataRoom =[
                'reserva_id' => $this->params['data']['reserva_id'],
            ];
            $room = ERPService::findReservationRoom($dataRoom);
            if($room['res'] > 0 && $room['data']['list']){
                array_push($response['data']['list']['room'],$room['data']['list']);
            }

            $dataPax =[
                'reserva_id' => $this->params['data']['reserva_id'],
            ];
            $pax = ERPService::findReservationPax($dataPax);
            if($pax['res'] > 0 && $pax['data']['list']){
                array_push($response['data']['list']['pax'],$pax['data']['list']);
            }

            $dataExperience =[
                'reserva_id' => $this->params['data']['reserva_id'],
            ];
            $experience = ERPService::findReservationExperience($dataExperience);
            if($experience['res'] > 0 && $experience['data']['list']){
                array_push($response['data']['list']['experience'],$experience['data']['list']);
            }

            $dataKey =[
               'reserva_id' => $this->params['data']['reserva_id'],
            ];
            $key = ERPService::findReservationKey($dataKey);
            if($key['res'] > 0 && $key['data']['list']){
                array_push($response['data']['list']['key'],$key['data']['list']);
            }

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

        ];
    }

}