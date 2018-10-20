<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationGuestPersistences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_guest_persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->integer('reservation_type_id')->unsigned()->nullable();
            $table->foreign('reservation_type_id')->references('id')->on('reservation_types');
            $table->text('nombre')->nullable();
            $table->text('apellido1')->nullable();
            $table->text('apellido2')->nullable();
            $table->text('nacionalidad')->nullable();
            $table->text('sexo')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('identificacion')->nullable();
            $table->text('tipo_documento')->nullable();
            $table->text('pais')->nullable();
            $table->text('email')->nullable();
            $table->text('telefono')->nullable();
            $table->text('img')->nullable();
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('reservation_guest_persistences');
    }
}
