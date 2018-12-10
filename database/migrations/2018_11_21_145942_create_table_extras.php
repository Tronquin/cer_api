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
            $table->integer('parent_id')->nullable();
            $table->integer('ubicacion_id');
            $table->string('nombre');
            $table->string('nombre_es')->nullable();
            $table->string('nombre_en')->nullable();
            $table->string('nombre_fr')->nullable();
            $table->string('nombre_zh')->nullable();
            $table->string('nombre_ru')->nullable();
            $table->string('nombre_po')->nullable();
            $table->string('descripcion_es')->nullable();
            $table->string('descripcion_en')->nullable();
            $table->string('descripcion_fr')->nullable();
            $table->string('descripcion_zh')->nullable();
            $table->string('descripcion_ru')->nullable();
            $table->string('descripcion_po')->nullable();
            $table->double('coste');
            $table->double('base_imponible');
            $table->double('iva_tipo');
            $table->string('manera_cobro')->nullable();
            $table->integer('servicio_gestion')->nullable();
            $table->integer('destacado')->nullable() ;
            $table->integer('activo')->nullable();
            $table->integer('cambia_hora_entrada')->nullable()->default(0);
            $table->integer('cambia_hora_salida')->nullable()->default(0);
            $table->string('front_image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('outstanding')->default(false);
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
