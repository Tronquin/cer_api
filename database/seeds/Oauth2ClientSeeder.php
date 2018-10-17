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
        $type->description = '';
        $type->token = md5(uniqid('Maquina',true));
        $type->type = 'machine';
        $type->save();

        $type = new \App\OAuth2Client();
        $type->description = '';
        $type->token = md5(uniqid('App',true));
        $type->type = 'app';
        $type->save();

        $type = new \App\OAuth2Client();
        $type->description = '';
        $type->token = md5(uniqid('Web',true));
        $type->type = 'web';
        $type->save();
    }
}
