<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLavabos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lavabos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lavabo_id');
            $table->enum('type',['web','erp'])->default('erp');
            $table->integer('tipologia_id');
            $table->string('tipo');
            $table->integer('espejo_aumento');
            $table->integer('secador');
            $table->integer('bide');
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
        Schema::dropIfExists('lavabos');
    }
}
