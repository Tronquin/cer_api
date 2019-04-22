<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryTypology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $typologies = \App\Typology::all();
        foreach ($typologies as $typology) {

            $gallery = new \App\Galery();
            $gallery->code = 'location-typology-' . $typology->id . '-main-gallery';
            $gallery->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $typologies = \App\Typology::all();
        foreach ($typologies as $typology) {

            $code = 'location-typology-' . $typology->id . '-main-gallery';
            $gallery = \App\Galery::query()->where('code', $code)->first();
            $gallery->delete();
        }
    }
}
