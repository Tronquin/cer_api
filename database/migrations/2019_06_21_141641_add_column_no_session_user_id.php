<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNoSessionUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->integer('no_session_user_id')->unsigned()->nullable();
            $table->foreign('no_session_user_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeign('reservation_no_session_user_id_foreign');
            $table->dropColumn('no_session_user_id');
            $table->integer('user_id')->unsigned()->nullable(false)->change();
        });
    }
}
