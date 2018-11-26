<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('ubicacion_id');
            $table->string('nombre');
            $table->string('nombre_es');
            $table->string('nombre_en');
            $table->string('nombre_fr');
            $table->string('nombre_zh');
            $table->string('nombre_ru');
            $table->string('nombre_po');
            $table->string('descripcion_es');
            $table->string('descripcion_en');
            $table->string('descripcion_fr');
            $table->string('descripcion_zh');
            $table->string('descripcion_ru');
            $table->string('descripcion_po');
            $table->double('coste');
            $table->double('base_imponible');
            $table->double('iva_tipo');
            $table->string('manera_cobro');
            $table->integer('servicio_gestion');
            $table->integer('destacado');
            $table->integer('activo');
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
        Schema::dropIfExists('extras');
    }
}
