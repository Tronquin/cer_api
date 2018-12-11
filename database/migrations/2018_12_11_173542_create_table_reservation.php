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
            $table->integer('checkin');
            $table->integer('checkout');
            $table->integer('typology_id');
            $table->integer('apartment_id');
            $table->integer('user_id');
            $table->integer('experience_id');
            $table->integer('regimen_id');
            $table->integer('policy_id');
            $table->integer('promotion_id');
            $table->integer('payment_id');
            $table->integer('adults');
            $table->integer('kids');
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
