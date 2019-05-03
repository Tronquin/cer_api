<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoadTagsChildren extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tag = new \App\Tag();
        $tag->description = 'CASTRO SERVICES';
        $tag->parent_id = 1;
        $tag->save();

        $tag = new \App\Tag();
        $tag->description = 'SPA';
        $tag->parent_id = 1;
        $tag->save();

        $tag = new \App\Tag();
        $tag->description = 'DESCUBRE LA CIUDAD';
        $tag->parent_id = 1;
        $tag->save();

        $tag = new \App\Tag();
        $tag->description = 'PAYMENT';
        $tag->parent_id = 1;
        $tag->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tags = \App\Tag::where('parent_id',1)->delete();
    }
}
