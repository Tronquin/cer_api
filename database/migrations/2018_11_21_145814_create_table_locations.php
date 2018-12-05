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
            $table->integer('parent_id')->nullable();
            $table->string('nombre');
            $table->integer('minimo_noches')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('plantas')->nullable();
            $table->integer('total_apartamentos')->nullable();
            $table->string('coordenadas')->nullable();
            $table->integer('total_ascensores')->nullable();
            $table->integer('parking')->nullable();
            $table->integer('restaurante')->nullable();
            $table->integer('terraza_comunitaria')->nullable();
            $table->integer('recepcion')->nullable();
            $table->integer('guarda_maletas')->nullable();
            $table->integer('knock')->nullable();
            $table->string('ip_ubicacion')->nullable();
            $table->float('iva_reservas')->nullable();
            $table->longText('descripcion_es')->nullable();
            $table->longText('descripcion_en')->nullable();
            $table->longText('descripcion_fr')->nullable();
            $table->longText('descripcion_po')->nullable();
            $table->longText('description')->nullable();
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
