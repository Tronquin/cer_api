<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartamento_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->string('nombre');
            $table->string('tipologia_id');
            $table->string('status')->nullable();
            $table->integer('ubicacion_id');
            $table->integer('planta')->nullable();
            $table->integer('puerta')->nullable();
            $table->integer('acceso_id')->nullable();
            $table->float('altura')->nullable();
            $table->integer('area')->nullable();
            $table->string('orientacion')->nullable();
            $table->integer('galeria_id')->nullable();
            $table->string('pass_emergencia')->nullable();
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
        Schema::dropIfExists('apartments');
    }
}
