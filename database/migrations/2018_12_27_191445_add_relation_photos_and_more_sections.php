<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationPhotosAndMoreSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos_and_more_sections', function (Blueprint $table) {
            $table->integer('section_apartment_id')->unsigned()->nullable();
            $table->foreign('section_apartment_id')->references('id')->on('section_apartments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos_and_more_sections', function (Blueprint $table) {
            $table->dropForeign('photos_and_more_sections_section_apartment_id_foreign');
            $table->dropColumn('section_apartment_id');
        });
    }
}
