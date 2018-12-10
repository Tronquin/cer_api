<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experiencia_id');
            $table->integer('ubicacion_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->string('nombre');
            $table->string('color')->nullable();
            $table->string('galeria_id')->nullable();
            $table->float('incidencia_porcentaje');
            $table->integer('predeterminada')->nullable();
            $table->integer('limpieza_cada_dias')->nullable();
            $table->integer('sabanas_cada_dias')->nullable();
            $table->integer('upgrade_extra_id')->nullable();
            $table->string('description')->nullable();
            $table->string('front_page')->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
