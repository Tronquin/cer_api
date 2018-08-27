<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationGuestPersistence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_guest_persistence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_persistence_id')->unsigned();
            $table->foreign('reservation_persistence_id')->references('id')->on('reservation_persistence');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type');
            $table->text('nombre')->nullable();
            $table->text('apellido')->nullable();
            $table->text('nacionalidad')->nullable();
            $table->text('identificacion')->nullable();
            $table->integer('tipo')->nullable();
            $table->text('email')->nullable();
            $table->integer('telefono')->nullable();
            $table->text('img')->nullable();
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
        Schema::dropIfExists('reservation_guest_persistence');
    }
}
