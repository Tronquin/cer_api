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
