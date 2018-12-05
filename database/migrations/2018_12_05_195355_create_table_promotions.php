<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promocion_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->integer('ubicacion_id');
            $table->string('para_web')->nullable();
            $table->string('nombre')->nullable();
            $table->float('incidencia_fijo')->nullable();
            $table->float('incidencia_porcentaje')->nullable();
            $table->string('orden_calculo')->nullable();
            $table->integer('activo')->nullable();
            $table->date('publicado_desde')->nullable();
            $table->date('publicado_hasta')->nullable();
            $table->date('alojado_desde')->nullable();
            $table->date('alojado_hasta')->nullable();
            $table->integer('min_noches')->nullable();
            $table->integer('max_noches')->nullable();
            $table->integer('release_desde')->nullable();
            $table->integer('release_hasta')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
