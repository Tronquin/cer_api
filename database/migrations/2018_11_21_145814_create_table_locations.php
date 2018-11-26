<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ubicacion_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->string('nombre');
            $table->integer('minimo_noches');
            $table->string('direccion');
            $table->integer('plantas');
            $table->integer('total_apartamentos');
            $table->string('coordenadas');
            $table->integer('total_ascensores');
            $table->integer('parking');
            $table->integer('restaurante');
            $table->integer('terraza_comunitaria');
            $table->integer('recepcion');
            $table->integer('guarda_maletas');
            $table->integer('knock');
            $table->string('ip_ubicacion');
            $table->float('iva_reservas');
            $table->longText('descripcion_es');
            $table->longText('descripcion_en');
            $table->longText('descripcion_fr');
            $table->longText('descripcion_po');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
