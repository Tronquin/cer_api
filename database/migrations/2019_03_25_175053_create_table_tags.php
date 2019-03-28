<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('tags');
            $table->timestamps();
        });

        \App\Tag::query()->delete();

        $tag = new \App\Tag();
        $tag->description = 'WEB';
        $tag->save();

        $tag = new \App\Tag();
        $tag->description = 'MACHINE';
        $tag->save();

        $tag = new \App\Tag();
        $tag->description = 'APP';
        $tag->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
