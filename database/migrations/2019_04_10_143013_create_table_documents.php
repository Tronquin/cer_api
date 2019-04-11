<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url'); //Storage path
            $table->string('description', 50); //Basic Description of the document
            $table->string('name')->unique(); //Document Name
            $table->string('extension'); //pdf, docx, doc, etc....
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->integer('extra_outstandings_id')->unsigned();
            $table->foreign('extra_outstandings_id')->referebces('id')->on('extra_outstandings');
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
        Schema::dropIfExists('documents');
    }
}
