<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCancellationPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_policy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('politica_cancelacion_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->integer('ubicacion_id');
            $table->string('nombre')->nullable();
            $table->string('nombre_cliente')->nullable();
            $table->float('incidencia_porcentaje')->nullable();
            $table->integer('activo')->nullable();
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
        Schema::dropIfExists('cancellation_policy');
    }
}
