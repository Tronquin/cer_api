<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumHascheckinmovil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_persistences', function (Blueprint $table) {
            $table->boolean('has_checkin_movil')->default(false)->after('status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_persistences', function (Blueprint $table) {
            $table->dropColumn('has_checkin_movil');
        });
    }
}
