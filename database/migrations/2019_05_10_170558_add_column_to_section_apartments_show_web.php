<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSectionApartmentsShowWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_apartments', function (Blueprint $table) {
            $table->boolean('show_web')->after('photo')->default(true);
            $table->string('icon')->nullable();
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
            $table->dropColumn('show_web');
            $table->dropColumn('icon');
        });
    }
}
