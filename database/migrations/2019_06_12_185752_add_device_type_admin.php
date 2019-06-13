<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeviceTypeAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $device = new \App\DeviceType();
        $device->code = 'admin';
        $device->save();

        $client = new \App\OAuth2Client();
        $client->description = 'Admin';
        $client->token = md5('Admin_Castro_Exclusive_Residences');
        $client->device_type_id = $device->id;
        $client->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\DeviceType::query()->where('code', 'admin')->delete();
    }
}
