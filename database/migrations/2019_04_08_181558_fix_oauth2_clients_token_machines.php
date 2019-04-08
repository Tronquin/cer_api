<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixOauth2ClientsTokenMachines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->integer('oauth2_client_id')->unsigned()->nullable();
            $table->foreign('oauth2_client_id')->references('id')->on('oauth2_clients');
        });

        $device = \App\DeviceType::query()->where('code', 'machine')->first();
        $clients = \App\OAuth2Client::query()->where('device_type_id', $device->id)->get();

        foreach ($clients as $client) {
            \App\Audit::query()->where('oauth2_client_id', $client->id)->delete();
            $client->forceDelete();
        }

        $machines = \App\Machine::all();
        foreach ($machines as $i => $machine) {

            $client = new \App\OAuth2Client();
            $client->description = 'Maquina ' . ($i + 1);
            $client->token = md5('Machine_' . $i . '_' . time());
            $client->device_type_id = $device->id;
            $client->save();

            $machine->oauth2_client_id = $client->id;
            $machine->save();
        }

        Schema::table('machines', function (Blueprint $table) {
            $table->integer('oauth2_client_id')->unsigned()->nullable(false)->change();
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
            $table->dropForeign('machines_oauth2_client_id_foreign');
            $table->dropColumn('oauth2_client_id');
        });

        $device = \App\DeviceType::query()->where('code', 'machine')->first()->id;
        $clients = \App\OAuth2Client::query()->where('device_type_id', $device->id)->get();

        foreach ($clients as $client) {
            \App\Audit::query()->where('oauth2_client_id', $client->id)->delete();
            $client->delete();
        }
    }
}
