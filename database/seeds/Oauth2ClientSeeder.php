<?php

use Illuminate\Database\Seeder;

class Oauth2ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\OAuth2Client();
        $type->description = 'Maquina';
        $type->token = md5('Machine_hotel_Castro_experiences');
        $type->device_type_id = \App\DeviceType::query()->where('code', 'machine')->first()->id;
        $type->save();

        $type = new \App\OAuth2Client();
        $type->description = 'Aplicacion movil';
        $type->token = md5('Movil_aplication_Castro_experiences');
        $type->device_type_id = \App\DeviceType::query()->where('code', 'app')->first()->id;
        $type->save();

        $type = new \App\OAuth2Client();
        $type->description = 'Pagina Web';
        $type->token = md5('Web_page_Castro_experiences');
        $type->device_type_id = \App\DeviceType::query()->where('code', 'web')->first()->id;
        $type->save();
    }
}
