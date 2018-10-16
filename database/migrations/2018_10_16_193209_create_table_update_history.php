<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUpdateHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oauth2_client_type_id')->unsigned();
            $table->foreign('oauth2_client_type_id')->references('id')->on('oauth2_client_types');
            $table->string('version', 10);
            $table->date('date');
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
        Schema::dropIfExists('update_history');
    }
}
