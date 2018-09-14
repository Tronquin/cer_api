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
        Schema::create('reservation_payment_persistence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->text('msg')->nullable();
            $table->integer('numOpBco')->unsigned()->nullable();
            $table->text('code')->nullable();
            $table->text('numRefTP')->nullable();
            $table->text('bIN')->nullable();
            $table->integer('numOpCO')->unsigned()->nullable();
            $table->text('red')->nullable();
            $table->text('codAut')->nullable();
            $table->text('aRC')->nullable();
            $table->integer('tipoLectura')->nullable();
            $table->text('moneda')->nullable();
            $table->text('tipoOp')->nullable();
            $table->text('cVM')->nullable();
            $table->text('txtBanco')->nullable();
            $table->text('tarjeta')->nullable();
            $table->float('taxFree')->nullable();
            $table->text('ticket')->nullable();
            $table->text('tipoTarjeta')->nullable();
            $table->text('terminal')->nullable();
            $table->float('importe')->nullable();
            $table->date('fechaContable')->nullable();
            $table->integer('pais')->unsigned()->nullable();
            $table->integer('idSesion')->unsigned()->nullable();
            $table->text('lBL')->nullable();
            $table->text('comercio')->nullable();
            $table->text('aID')->nullable();
            $table->text('txtMarca')->nullable();
            $table->text('titular')->nullable();
            $table->text('emisor')->nullable();
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
        Schema::dropIfExists('reservation_payment_persistence');
    }
}
