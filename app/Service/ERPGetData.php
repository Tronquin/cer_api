<?php
namespace App\Service;

use App\Service\ERPService;
use App\Location;
use App\Extra;
use App\Experience;
use App\Apartment;
use App\Handler\GeneralHandlers\FindLocationsHandler;

class ERPGetData {

    /**
     * Busca la data del Erp y la persiste en la bd
     *
     * @param $data
     * @return array
     */
    public static function getData()
    {
        /**
         * Llenamos la tabla locations
         */
        $ubicaciones = ERPService::findLocations();

        if(count($ubicaciones)){
            foreach($ubicaciones as $ubicacion){
                //Guardamos los id de las ubicaciones para las siguientes consultas
                $ubicacion_id[] = ['id' => $ubicacion['id']];
                $ubicacion_erp = Location::where('ubicacion_id','=',$ubicacion['id'])
                    ->where('type','=','erp')
                    ->firstOrNew(['ubicacion_id' => $ubicacion['id'],'type' =>'erp']);
                
                $ubicacion_erp->ubicacion_id = $ubicacion['id'];
                $ubicacion_erp->nombre = $ubicacion['nombre'];
                $ubicacion_erp->minimo_noches = $ubicacion['minimo_noches'];
                $ubicacion_erp->direccion = $ubicacion['direccion'];
                $ubicacion_erp->plantas = $ubicacion['plantas'];
                $ubicacion_erp->total_apartamentos = $ubicacion['total_apartamentos'];
                $ubicacion_erp->coordenadas = $ubicacion['coordenadas'];
                $ubicacion_erp->total_ascensores = $ubicacion['total_ascensores'];
                $ubicacion_erp->parking = $ubicacion['parking'];
                $ubicacion_erp->restaurante = $ubicacion['restaurante'];
                $ubicacion_erp->terraza_comunitaria = $ubicacion['terraza_comunitaria'];
                $ubicacion_erp->recepcion = $ubicacion['recepcion'];
                $ubicacion_erp->guarda_maletas = $ubicacion['guarda_maletas'];
                $ubicacion_erp->knock = $ubicacion['knock'];
                $ubicacion_erp->ip_ubicacion = $ubicacion['ip_ubicacion'];
                $ubicacion_erp->iva_reservas = $ubicacion['iva_reservas'];
                $ubicacion_erp->descripcion_es = $ubicacion['descripcion_es'];
                $ubicacion_erp->descripcion_en = $ubicacion['descripcion_en'];
                $ubicacion_erp->descripcion_fr = $ubicacion['descripcion_fr'];
                $ubicacion_erp->descripcion_po = $ubicacion['descripcion_po'];
                
                $response = $ubicacion_erp->save();
                
            }
            if(count($ubicacion_id)){
                foreach($ubicacion_id as $ubicacion){
                    //$ubicacion_id[] = ['id' => $ubicacion['id']];
                    $data = ERPService::findUbicacionData(['ubicacion_id' => $ubicacion['id']]);
                    $experiencias = $data['experiencias'];
                    $extras = $data['extras'];
                    $apartamentos = $data['apartamentos'];

                    foreach($extras as $extra){
                        $extra_erp = Extra::where('extra_id','=',$extra['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['extra_id' => $extra['id'],'type' =>'erp']);

                        $extra_erp->extra_id = $extra['id'];
                        $extra_erp->ubicacion_id = $extra['ubicacion_id'];
                        $extra_erp->nombre = $extra['nombre'];
                        $extra_erp->nombre_es = $extra['nombre_es'];
                        $extra_erp->nombre_en = $extra['nombre_en'];
                        $extra_erp->nombre_fr = $extra['nombre_fr'];
                        $extra_erp->nombre_zh = $extra['nombre_zh'];
                        $extra_erp->nombre_ru = $extra['nombre_ru'];
                        $extra_erp->nombre_po = $extra['nombre_po'];
                        $extra_erp->descripcion_es = $extra['descripcion_es'];
                        $extra_erp->descripcion_en = $extra['descripcion_en'];
                        $extra_erp->descripcion_fr = $extra['descripcion_fr'];
                        $extra_erp->descripcion_zh = $extra['descripcion_zh'];
                        $extra_erp->descripcion_ru = $extra['descripcion_ru'];
                        $extra_erp->descripcion_po = $extra['descripcion_po'];
                        $extra_erp->coste = $extra['coste'];
                        $extra_erp->base_imponible = $extra['base_imponible'];
                        $extra_erp->iva_tipo = $extra['iva_tipo'];
                        $extra_erp->manera_cobro = $extra['manera_cobro'];
                        $extra_erp->servicio_gestion = $extra['servicio_gestion'];
                        $extra_erp->destacado = $extra['destacado'];
                        $extra_erp->activo = $extra['activo'];
                        $extra_erp->cambia_hora_entrada = $extra['cambia_hora_entrada'];
                        $extra_erp->cambia_hora_salida = $extra['cambia_hora_salida'];

                        $extra_erp->save();
                    }
                    foreach($apartamentos as $apartamento){
                        $apartment_erp = Apartment::where('apartamento_id','=',$apartamento['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['apartamento_id' => $apartamento['id'],'type' =>'erp']);

                        $apartment_erp->apartamento_id = $apartamento['id'];
                        $apartment_erp->ubicacion_id = $apartamento['ubicacion_id'];
                        $apartment_erp->nombre = $apartamento['nombre'];
                        $apartment_erp->tipologia_id = $apartamento['tipologia_id'];
                        $apartment_erp->status = $apartamento['status'];
                        $apartment_erp->planta = $apartamento['planta'];
                        $apartment_erp->puerta = $apartamento['puerta'];
                        $apartment_erp->acceso_id = $apartamento['acceso_id'];
                        $apartment_erp->altura = $apartamento['altura'];
                        $apartment_erp->area = $apartamento['area'];
                        $apartment_erp->orientacion = $apartamento['orientacion'];
                        $apartment_erp->galeria_id = $apartamento['galeria_id'];
                        $apartment_erp->pass_emergencia = $apartamento['pass_emergencia'];

                        $apartment_erp->save();
                    }
                    foreach($experiencias as $experiencia){
                        $experiencia_erp = Experience::where('experiencia_id','=',$experiencia['id'])
                        ->where('type','=','erp')
                        ->firstOrNew([]);

                        $experiencia_erp->experiencia_id = $experiencia['id'];
                        $experiencia_erp->ubicacion_id = $experiencia['ubicacion_id'];
                        $experiencia_erp->nombre = $experiencia['nombre'];
                        $experiencia_erp->color = $experiencia['color'];
                        $experiencia_erp->galeria_id = $experiencia['galeria_id'];
                        $experiencia_erp->incidencia_porcentaje = $experiencia['incidencia_porcentaje'];
                        $experiencia_erp->predeterminada = $experiencia['predeterminada'];
                        $experiencia_erp->limpieza_cada_dias = $experiencia['limpieza_cada_dias'];
                        $experiencia_erp->sabanas_cada_dias = $experiencia['sabanas_cada_dias'];
                        $experiencia_erp->upgrade_extra_id = $experiencia['upgrade_extra_id'];

                        $extraIds = [];
                        foreach ($experiencia['extras'] as $extra) {
                            $extraIds[] = Extra::where('extra_id', $extra['id'])->first()->id;
                        }
                        $apartamentoIds = [];
                        foreach ($experiencia['apartamentos'] as $apartamento) {
                            $apartamentoIds[] = Apartment::where('apartamento_id', $apartamento['id'])->first()->id;
                        }
                        $experiencia_erp->save();

                        $experiencia_erp->extras()->sync($extraIds);  
                        $experiencia_erp->apartamentos()->sync($apartamentoIds);                     
                    }
                }
            }
        }else{
            $response = 'Locations Not Found';
        }

        return $ubicacion_id;
    
    }

}