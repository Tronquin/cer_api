<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableMachineComponentErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_component_errors', function (Blueprint $table) {
            $table->dropForeign(['component_id']);

            $table->foreign('component_id')->references('id')->on('components');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_component_errors', function (Blueprint $table) {
            $table->dropForeign(['component_id']);

            $table->foreign('component_id')->references('id')->on('machines');
            
        });
    }
}
