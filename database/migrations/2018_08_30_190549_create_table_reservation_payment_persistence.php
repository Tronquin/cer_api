<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationPaymentPersistence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_pago_persistence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->boolean('respuesta');
            $table->text('msg');
            $table->integer('numOpBco')->unsigned();
            $table->text('code');
            $table->text('numRefTP');
            $table->text('bIN');
            $table->integer('numOpCO')->unsigned();
            $table->text('red');
            $table->text('codAut');
            $table->text('aRC');
            $table->integer('tipoLectura');
            $table->text('moneda');
            $table->text('tipoOp');
            $table->text('cVM');
            $table->text('txtBanco');
            $table->text('tarjeta');
            $table->float('taxFree');
            $table->text('ticket');
            $table->text('tipoTarjeta');
            $table->text('terminal');
            $table->float('importe');
            $table->date('fechaContable');
            $table->integer('pais')->unsigned();
            $table->integer('idSesion')->unsigned();
            $table->text('lBL');
            $table->text('comercio');
            $table->text('aID');
            $table->text('txtMarca');
            $table->text('titular');
            $table->text('emisor');
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
        Schema::dropIfExists('reservation_pago_persistence');
    }
}
