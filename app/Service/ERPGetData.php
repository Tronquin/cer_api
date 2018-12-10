<?php
namespace App\Service;

use App\Service\ERPService;
use App\Location;
use App\Extra;
use App\Experience;
use App\Apartment;
use App\Typology;
use App\Package;
use App\Galery;
use App\Photo;
use App\CancellationPolicy;
use App\Promotion;
use Illuminate\Support\Facades\Storage;
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
        $galerias = [];

        if(count($ubicaciones)){
            foreach($ubicaciones as $ubicacion){
                // Guardamos los id de las ubicaciones para las siguientes consultas
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

                    $data = ERPService::findUbicacionData(['ubicacion_id' => $ubicacion['id']]);
                    $experiencias = $data['experiencias'];
                    $extras = $data['extras'];
                    $apartamentos = $data['apartamentos'];
                    $tipologias = $data['tipologias'];
                    $packages = $data['tarifas'];
                    $politica_cancelacions = $data['politica_cancelacions'];
                    $promocions = $data['promocions'];

                    // Tabla Tipologias
                    foreach($tipologias as $tipologia){

                        foreach($tipologia['galerias'] as $tipologiaGalery){
                            $galerias[] = $tipologiaGalery['id'];
                        }
                        
                        $tipologia_erp = Typology::where('tipologia_id','=',$tipologia['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['tipologia_id' => $tipologia['id'],'type' =>'erp']);

                        $tipologia_erp->tipologia_id = $tipologia['id'];
                        $tipologia_erp->ubicacion_id = $tipologia['ubicacion_id'];
                        $tipologia_erp->nombre_manual = $tipologia['nombre_manual'];
                        $tipologia_erp->status = $tipologia['status'];
                        $tipologia_erp->max = $tipologia['max'];
                        $tipologia_erp->min = $tipologia['min'];
                        $tipologia_erp->incidencia_porcentaje = $tipologia['incidencia_porcentaje'];
                        $tipologia_erp->descripcion_es = $tipologia['descripcion_es'];
                        $tipologia_erp->descripcion_en = $tipologia['descripcion_en'];
                        $tipologia_erp->descripcion_fr = $tipologia['descripcion_fr'];
                        $tipologia_erp->descripcion_po = $tipologia['descripcion_po'];

                        $tipologia_erp->save();
                    }

                    // Tabla Promociones
                    foreach($promocions as $promocion){
                        $promocion_erp = Promotion::where('promocion_id','=',$promocion['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['promocion_id' => $promocion['id'],'type' =>'erp']);

                        $promocion_erp->promocion_id = $promocion['id'];
                        $promocion_erp->ubicacion_id = $promocion['ubicacion_id'];
                        $promocion_erp->para_web = $promocion['para_web'];
                        $promocion_erp->nombre = $promocion['nombre'];
                        $promocion_erp->incidencia_fijo = $promocion['incidencia_fijo'];
                        $promocion_erp->incidencia_porcentaje = $promocion['incidencia_porcentaje'];
                        $promocion_erp->incidencia_porcentaje = $promocion['incidencia_porcentaje'];
                        $promocion_erp->orden_calculo = $promocion['orden_calculo'];
                        $promocion_erp->activo = $promocion['activo'];
                        $promocion_erp->publicado_desde = $promocion['publicado_desde'];
                        $promocion_erp->publicado_hasta = $promocion['publicado_hasta'];
                        $promocion_erp->alojado_desde = $promocion['alojado_desde'];
                        $promocion_erp->alojado_hasta = $promocion['alojado_hasta'];
                        $promocion_erp->min_noches = $promocion['min_noches'];
                        $promocion_erp->max_noches = $promocion['max_noches'];
                        $promocion_erp->release_desde = $promocion['release_desde'];
                        $promocion_erp->release_hasta = $promocion['release_hasta'];

                        $promocion_erp->save();
                    }

                    // Tabla cancelacion y politicas
                    foreach($politica_cancelacions as $politica_cancelacion){
                        $politica_cancelacions_erp = CancellationPolicy::where('politica_cancelacion_id','=',$politica_cancelacion['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['politica_cancelacion_id' => $politica_cancelacion['id'],'type' =>'erp']);

                        $politica_cancelacions_erp->politica_cancelacion_id = $politica_cancelacion['id'];
                        $politica_cancelacions_erp->ubicacion_id = $politica_cancelacion['ubicacion_id'];
                        $politica_cancelacions_erp->nombre = $politica_cancelacion['nombre'];
                        $politica_cancelacions_erp->nombre_cliente = $politica_cancelacion['nombre_cliente'];
                        $politica_cancelacions_erp->incidencia_porcentaje = $politica_cancelacion['incidencia_porcentaje'];
                        $politica_cancelacions_erp->activo = $politica_cancelacion['activo'];

                        $politica_cancelacions_erp->save();
                    }

                    // Tabla Extra
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

                    // Tabla Tarifa
                    foreach($packages as $package){
                        $package_erp = Package::where('tarifa_id','=',$package['id'])
                            ->where('type','=','erp')
                            ->firstOrNew(['tarifa_id' => $package['id'],'type' =>'erp']);
                        
                        $package_erp->tarifa_id = $package['id'];
                        $package_erp->ubicacion_id = $package['ubicacion_id'];
                        $package_erp->nombre = $package['nombre'];
                        $package_erp->incidencia_fijo = $package['incidencia_fijo'];
                        $package_erp->incidencia_porcentaje = $package['incidencia_porcentaje'];
                        $package_erp->extra_id = $package['extra_id'];
                        $package_erp->activo = $package['activo'];
                        $package_erp->orden_calculo = $package['orden_calculo'];

                        $package_erp->save();
                    }

                    // Tabla Apartamento
                    foreach($apartamentos as $apartamento){

                        $galerias[] = $apartamento['galeria_id'];

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

                    // Tabla Experiencia
                    foreach($experiencias as $experiencia){
                        $galerias[] = $experiencia['galeria_id'];

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

                        // Relacion muchos a muchos Experiencia-extras
                        $extraIds = [];
                        foreach ($experiencia['extras'] as $extra) {
                            $extraIds[] = Extra::where('extra_id', $extra['id'])->first()->id;
                        }

                        // Relacion muchos a muchos Experiencia-apartamentos
                        $apartamentoIds = [];
                        foreach ($experiencia['apartamentos'] as $apartamento) {
                            $apartamentoIds[] = Apartment::where('apartamento_id', $apartamento['id'])->first()->id;
                        }
                        $experiencia_erp->save();

                        // Extableciendo Relaciones
                        $experiencia_erp->extras()->sync($extraIds);  
                        $experiencia_erp->apartamentos()->sync($apartamentoIds);                     
                    }
                }
                $galerias = array_unique($galerias);
                foreach($galerias as $galeria){
                    try{
                        $data_galeria[] = ERPService::findGaleryById(['galeria_id' => $galeria]);
                    }catch (\Exception $e){

                    }
                }
                // Tabla Galeria
                foreach($data_galeria as $galeria){

                    $galeria_erp = Galery::where('galeria_id','=',$galeria['id'])
                        ->where('type','=','erp')
                        ->firstOrNew(['galeria_id' => $galeria['id'],'type' =>'erp']);

                    $galeria_erp->galeria_id = $galeria['id'];
                    $galeria_erp->nombre = isset($galeria['nombre']) ? $galeria['nombre'] : "";
                    $galeria_erp->nombre_en = isset($galeria['nombre_en']) ? $galeria['nombre_en'] : "";
                    $galeria_erp->nombre_fr = isset($galeria['nombre_fr']) ? $galeria['nombre_fr'] : "";
                    $galeria_erp->nombre_po = isset($galeria['nombre_po']) ? $galeria['nombre_po'] : "";
                    $galeria_erp->tipologia_id = isset($galeria['tipologia_id']) ? $galeria['tipologia_id'] : 0;

                    $galeria_erp->save();
                    if(isset($galeria['fotos'])){
                        foreach($galeria['fotos'] as $foto){

                            $foto_erp = Photo::where('foto_id','=',$foto['id'])
                                ->where('type','=','erp')
                                ->firstOrNew(['foto_id' => $foto['id'],'type' =>'erp']);

                                $foto_erp->foto_id = $foto['id'];
                                $foto_erp->galeria_id = $foto['galeria_id'];
                                $photoData = explode('.',$foto['archivo']);
                                $photo = explode(" ",$photoData[0]);
                                $photo = implode("%20",$photo);
                                $photoName = str_slug($photo.'.'.$photoData[1]);
                                try{
                                    $imagen = file_get_contents("https://erp.castroexclusiveresidences.com/uploads/galerias/".$photo.'.'.$photoData[1]);
                                    Storage::disk('public')->put('erpimages/'.$photoName, $imagen);

                                }catch (\Exception $e){
                                   
                                }
                                
                                $foto_erp->archivo = str_slug($foto['archivo']);
                                $foto_erp->descripcion_es = $foto['descripcion_es'];
                                $foto_erp->descripcion_en = $foto['descripcion_en'];
                                $foto_erp->descripcion_fr = $foto['descripcion_fr'];
                                $foto_erp->descripcion_zh = $foto['descripcion_zh'];
                                $foto_erp->descripcion_ru = $foto['descripcion_ru'];
                                $foto_erp->descripcion_po = $foto['descripcion_po'];

                                $foto_erp->save();
                        }
                    }
                }
            }
        }else{
            $response = 'Locations Not Found';
        }

        return $ubicacion_id;
    
    }

}