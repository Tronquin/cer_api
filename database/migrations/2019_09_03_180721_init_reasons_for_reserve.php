<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitReasonsForReserve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $reasons_info = new \App\ReasonsInfo();
        $reasons_info->location_id = null;
        $reasons_info->main_photo = 'reason-info-main-img990x459-5d30abea4be67';
        $reasons_info->description_photo = 'reason-info-description-img601x459-5d30abeaae813';
        $reasons_info->save();

        $fieldTranslations = (new \App\ReasonsInfo())->fieldTranslations();
        foreach($fieldTranslations as &$field){
            if($field['iso'] === 'es'){
                foreach($field['fields'] as &$trans){
                    if($trans['field'] === 'description') $trans['translation'] = 'Vamos a darte cuartro razones para que vengas a conocernos, para que elijas viajar diferente.
Aunque lo que más nos gustaría, es que seas tú quien nos digas por qué has venido y sobre todo por qué volverás.';

                    if($trans['field'] === 'floating_title') $trans['translation'] = '¿POR QUE RESERVAR CON NOSOTROS?';
                    if($trans['field'] === 'main_title') $trans['translation'] = 'RAZONES PARA RESERVAR';
                    if($trans['field'] === 'alt_photo') $trans['translation'] = 'img_principal';
                    if($trans['field'] === 'alt_description_photo') $trans['translation'] = 'img_secondary';
                }
            }
        }
        $reasons_info->updateFieldTranslations($fieldTranslations);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
