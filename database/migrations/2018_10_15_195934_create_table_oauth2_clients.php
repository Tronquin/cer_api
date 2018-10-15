<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOauth2Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth2_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 50);
            $table->string('client_id');
            $table->string('secret_id');
            $table->integer('oauth2_client_type_id')->unsigned();
            $table->foreign('oauth2_client_type_id')->references('id')->on('oauth2_client_types');
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
        Schema::dropIfExists('oauth2_clients');
    }
}
