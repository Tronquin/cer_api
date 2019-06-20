<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Tag;

class AddOrderTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->integer('order')->default(1);
        });
        
        $tag = new Tag();
        $tag->description = 'EXCLUSIVE SERVICES';
        $tag->parent_id = 1;
        $tag->save();

        $tagParent = Tag::where('description','EXCLUSIVE SERVICES')->first();

        $tag = Tag::where('description','DESCUBRE LA CIUDAD')->first();
        $tag->parent_id = $tagParent->id;
        $tag->save();
        
        $tag = Tag::where('description','SPA')->first();
        $tag->parent_id = $tagParent->id;
        $tag->save();

        $tag = Tag::where('description','CASTRO SERVICES')->first();
        $tag->description = 'SERVICES';
        $tag->parent_id = $tagParent->id;
        $tag->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        $tag = Tag::where('description','DESCUBRE LA CIUDAD')->first();
        $tag->parent_id = 1;
        $tag->save();
        
        $tag = Tag::where('description','SPA')->first();
        $tag->parent_id = 1;
        $tag->save();

        $tag = Tag::where('description','SERVICES')->first();
        $tag->description = 'CASTRO SERVICES';
        $tag->parent_id = 1;
        $tag->save();

        $tag = Tag::where('description','EXCLUSIVE SERVICES')->first()->delete();
    }
}
