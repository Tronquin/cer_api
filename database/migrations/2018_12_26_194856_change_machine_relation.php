<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMachineRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('delete from machine_component_errors');
        \Illuminate\Support\Facades\DB::statement('delete from machine_component');
        \Illuminate\Support\Facades\DB::statement('delete from machines');

        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign('machines_machine_ubication_id_foreign');
            $table->dropColumn('machine_ubication_id');
            $table->dropColumn('api_url');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('time_repose');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropColumn('location_id');
            $table->integer('machine_ubication_id')->unsigned();
            $table->foreign('machine_ubication_id')->references('id')->on('locations');
            $table->dropColumn('time_repose');
        });
    }
}
