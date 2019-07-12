<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tag = new \App\Tag();
        $tag->description = 'ADD SERVICES';
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
        $tag = \App\Tag::where('description','ADD SERVICES')->first()->delete();
    }
}
