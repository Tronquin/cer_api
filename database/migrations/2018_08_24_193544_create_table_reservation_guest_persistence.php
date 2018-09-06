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
            $table->integer('reserva_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('type');
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
