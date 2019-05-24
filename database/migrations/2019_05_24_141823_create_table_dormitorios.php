<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDormitorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitorios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dormitorio_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('tipologia_id');
            $table->string('cama');
            $table->integer('camas_cantidad');
            $table->integer('tv');
            $table->integer('armario');
            $table->integer('balcon');
            $table->integer('telefono');
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
        Schema::dropIfExists('dormitorios');
    }
}
