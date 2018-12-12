<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsApiUrlMachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->string('api_url')->default('')->after('machine_ubication_id');
            $table->string('device_url')->default('')->after('api_url');
            $table->string('phone')->default('')->after('device_url');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->string('api_url')->unsigned()->change();
            $table->string('device_url')->unsigned()->change();
            $table->string('phone')->unsigned()->change();
        });
    }
}
