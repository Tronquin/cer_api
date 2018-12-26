<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhotosAndMoreSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_and_more_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('photo_and_more_id')->unsigned();
            $table->foreign('photo_and_more_id')->references('id')->on('photos_and_more');
            $table->integer('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->string('video');
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
        Schema::dropIfExists('photos_and_more_sections');
    }
}
