<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('salon_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('tipologia_id');
            $table->integer('tv');
            $table->integer('sofas');
            $table->integer('sofacama');
            $table->integer('comedor');
            $table->integer('sillas');
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
        Schema::dropIfExists('salones');
    }
}
