<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypologyCharacteristic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typology_characteristic', function (Blueprint $table) {
            $table->integer('typology_id')->unsigned();
            $table->integer('characteristic_id')->unsigned();
            $table->foreign('typology_id')->references('id')->on('typologies');
            $table->foreign('characteristic_id')->references('id')->on('characteristics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typology_characteristic');
    }
}
