<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCancelationpolicyIconImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cancellation_policys', function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->string('front_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancellation_policys', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('front_image');
        });
    }
}
