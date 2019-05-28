<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRedesContacToLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('logo');
            $table->string('twiter')->nullable()->after('logo');
            $table->string('instagram')->nullable()->after('logo');
            $table->string('email_contact')->nullable()->after('logo');
            $table->string('phone_contact')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('twiter');
            $table->dropColumn('instagram');
            $table->dropColumn('email_contact');
            $table->dropColumn('phone_contact');
        });
    }
}
