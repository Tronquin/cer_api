<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMachineComponentErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_component_errors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->integer('component_id')->unsigned();
            $table->foreign('component_id')->references('id')->on('machines');
            $table->string('fail');
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
        Schema::dropIfExists('machine_component_errors');
    }
}
