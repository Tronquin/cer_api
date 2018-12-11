<?php

use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gallery = new \App\Galery();
        $gallery->code = 'home-main-gallery';
        $gallery->save();
    }
}
