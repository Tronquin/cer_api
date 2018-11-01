<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_persistences', function (Blueprint $table) {
            $table->integer('status_id')->default(1)->unsigned()->change();
            
        });
        Schema::table('reservation_guest_persistences', function (Blueprint $table) {
            $table->integer('status_id')->default(1)->unsigned()->change();
            
        });
        Schema::table('reservation_service_persistences', function (Blueprint $table) {
            $table->integer('status_id')->default(1)->unsigned()->change();
            
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
            $table->integer('status_id')->unsigned()->change();
        });
        Schema::table('reservation_guest_persistences', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->change();
        });
        Schema::table('reservation_service_persistences', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->change();
        });
    }
}
