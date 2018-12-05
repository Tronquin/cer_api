<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('foto_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('parent_id')->nullable();
            $table->integer('galeria_id');
            $table->string('archivo');
            $table->string('descripcion_es')->nullable();
            $table->string('descripcion_en')->nullable();
            $table->string('descripcion_fr')->nullable();
            $table->string('descripcion_zh')->nullable();
            $table->string('descripcion_ru')->nullable();
            $table->string('descripcion_po')->nullable();
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
        Schema::dropIfExists('photos');
    }
}
