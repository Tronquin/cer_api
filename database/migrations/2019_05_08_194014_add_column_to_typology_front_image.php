<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTypologyFrontImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('typologies', function (Blueprint $table) {
            $table->string('front_image')->nullable()->before('descripcion_po');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('typologies', function (Blueprint $table) {
            $table->dropColumn('front_image');
        });
    }
}
