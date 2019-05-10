<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSectionApartmentExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_apartment_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id')->unsigned();
            $table->foreign('extra_id')->references('id')->on('extras');
            $table->integer('section_apartment_id')->unsigned();
            $table->foreign('section_apartment_id')->references('id')->on('section_apartments');
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
        Schema::dropIfExists('section_apartment_extras');
    }
}
