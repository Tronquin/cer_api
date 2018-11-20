<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class UpdateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rol_id')->unsigned()->default(2)->after('email');
        });
        $userExist = User::query()->where('name', 'Admin')->first();

        if (!$userExist) { 
            $user = new User();
            $user->name = 'Admin';
            $user->last_name = '';
            $user->email = 'admin@navicu.com';
            $user->password = Hash::make('Castro_Experience');
            $user->rol_id = 1;
            $user->save();
        }else{
            $userExist->rol_id = 1;
            $userExist->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol_id');
        });
    }
}
