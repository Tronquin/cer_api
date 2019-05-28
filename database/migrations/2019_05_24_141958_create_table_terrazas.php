<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTerrazas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrazas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('terraza_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('tipologia_id');
            $table->integer('mesa');
            $table->integer('sillas');
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
        Schema::dropIfExists('terrazas');
    }
}
