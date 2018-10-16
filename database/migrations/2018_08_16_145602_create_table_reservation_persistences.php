<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationPersistences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned()->nullable();
            $table->integer('adults')->unsigned()->nullable();
            $table->integer('kids')->unsigned()->nullable();
            $table->integer('tipologia_id')->unsigned()->nullable();
            $table->integer('apartamento_id')->unsigned()->nullable();
            $table->integer('plan_id')->unsigned()->nullable();
            $table->integer('experience_id')->unsigned()->nullable();
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
        Schema::dropIfExists('reservation_persistences');
    }
}
