<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFieldReservationPaymentPersistence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_payment_persistences', function (Blueprint $table) {
            $table->string('reserva_id')->change();
            $table->renameColumn('reserva_id','reservas_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_payment_persistences', function (Blueprint $table) {
            $table->integer('reserva_id')->change();
            $table->renameColumn('reservas_ids','reserva_id');
        });
    }
}
