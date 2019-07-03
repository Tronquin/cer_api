<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoadImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('format', 4)->nullable();
            $table->string('category', 15)->nullable();
        });

        $images = \Illuminate\Support\Facades\Storage::disk('public')->allFiles();

        foreach ($images as $image) {
            $explode = explode('/', $image);
            $lastPartUrl = last($explode);

            $nameAndFormat = explode('.', $lastPartUrl);

            if (
                count($nameAndFormat) === 2 &&
                ! empty($nameAndFormat[0]) &&
                ! empty($nameAndFormat[1]) &&
                $nameAndFormat[1] !== 'xlsx'
            ) {
                // Comprueba si tiene nombre y formato, en este caso se asume que es una imagen

                $path = storage_path('app/public/' . $image);
                $info = getimagesize($path);
                $width = $info[0];
                $height = $info[1];
                $dirName = $explode[ count($explode) - 2 ];

                $imageInstance = \App\Imagen::query()->where('url', $image)->first();

                if (! $imageInstance) {
                    $imageInstance = new \App\Imagen();
                    $imageInstance->slug = $image;
                    $imageInstance->url = $image;
                }

                $imageInstance->width = $width;
                $imageInstance->height = $height;
                $imageInstance->format = $nameAndFormat[1];

                if ($nameAndFormat[1] === 'svg') {
                    $imageInstance->category = \App\Imagen::CATEGORY_ICON;
                } elseif ($dirName === 'erpimages') {
                    $imageInstance->category = \App\Imagen::CATEGORY_ERP;
                } else {
                    $imageInstance->category = \App\Imagen::CATEGORY_GENERAL;
                }

                $imageInstance->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('format');
            $table->dropColumn('category');
        });
    }
}
