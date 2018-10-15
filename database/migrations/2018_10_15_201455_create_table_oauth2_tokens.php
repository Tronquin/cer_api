<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOauth2Tokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth2_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oauth2_client_id')->unsigned();
            $table->foreign('oauth2_client_id')->references('id')->on('oauth2_clients');
            $table->string('token');
            $table->dateTime('expired_at');
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
        Schema::dropIfExists('oauth2_tokens');
    }
}
