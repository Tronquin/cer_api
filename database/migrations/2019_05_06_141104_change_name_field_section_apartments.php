<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameFieldSectionApartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_apartments', function (Blueprint $table) {
            $table->renameColumn('ubicacion_id','location_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_apartments', function (Blueprint $table) {
            $table->renameColumn('location_id','ubicacion_id');
        });
    }
}
