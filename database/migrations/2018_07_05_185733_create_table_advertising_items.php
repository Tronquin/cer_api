<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdvertisingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertising_id')->unsigned();
            $table->foreign('advertising_id')->references('id')->on('advertising');
            $table->text('params');
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
        Schema::dropIfExists('advertising_items');
    }
}
