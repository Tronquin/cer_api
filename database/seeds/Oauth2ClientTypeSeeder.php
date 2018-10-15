<?php

use Illuminate\Database\Seeder;

class Oauth2ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\OAuth2ClientType();
        $type->code = 'machine';
        $type->save();

        $type = new \App\OAuth2ClientType();
        $type->code = 'app';
        $type->save();

        $type = new \App\OAuth2ClientType();
        $type->code = 'web';
        $type->save();
    }
}
