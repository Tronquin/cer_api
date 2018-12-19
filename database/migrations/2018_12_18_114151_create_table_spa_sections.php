<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpaSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spa_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spa_info_id')->unsigned();
            $table->foreign('spa_info_id')->references('id')->on('spa_info');
            $table->string('name');
            $table->string('ico');
            $table->string('photo');
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
        Schema::dropIfExists('spa_sections');
    }
}
