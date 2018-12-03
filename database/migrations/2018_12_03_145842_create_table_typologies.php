<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typologies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipologia_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->integer('ubicacion_id');
            $table->string('nombre_manual');
            $table->int('status')->nullable();
            $table->int('max')->nullable();
            $table->int('min')->nullable();
            $table->float('incidencia_porcentaje');
            $table->string('descripcion_es')->nullable();
            $table->string('descripcion_en')->nullable();
            $table->string('descripcion_fr')->nullable();
            $table->string('descripcion_po')->nullable();
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
        Schema::dropIfExists('typologies');
    }
}
