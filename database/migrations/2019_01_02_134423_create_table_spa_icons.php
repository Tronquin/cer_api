<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSpaIcons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spa_icons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spa_section_id')->unsigned();
            $table->foreign('spa_section_id')->references('id')->on('spa_sections');
            $table->string('ico')->nullable();
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
        Schema::dropIfExists('spa_icons');
    }
}
