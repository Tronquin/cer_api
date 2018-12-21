<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ubicacion_id');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('typology_id')->unsigned();
            $table->integer('apartment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('experience_id')->unsigned();
            $table->integer('regimen_id')->unsigned();
            $table->integer('policy_id');
            $table->integer('promotion_id');
            $table->integer('adults');
            $table->integer('kids');
            $table->float('amount');
            $table->foreign('typology_id')->references('id')->on('typologies');
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('experience_id')->references('id')->on('experiences');
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
        Schema::dropIfExists('reservation');
    }
}
