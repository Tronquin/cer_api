<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCocinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cocina_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('tipologia_id');
            $table->integer('nevera');
            $table->integer('vitro');
            $table->integer('microondas');
            $table->integer('horno');
            $table->integer('maquina_cafe');
            $table->integer('hervidor');
            $table->integer('lavadora');
            $table->integer('secadora');
            $table->integer('plancha');
            $table->integer('lavavajillas');
            $table->integer('mesa_comedor');
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
        Schema::dropIfExists('cocinas');
    }
}
