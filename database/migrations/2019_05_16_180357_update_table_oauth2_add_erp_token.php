<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableOauth2AddErpToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $type = new \App\OAuth2Client();
        $type->description = 'Erp_Castro';
        $type->token = md5('Erp_Castro_Castro_experiences');
        $type->device_type_id = \App\DeviceType::query()->where('code', 'web')->first()->id;
        $type->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
