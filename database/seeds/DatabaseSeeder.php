<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(TypeSeeder::class);
        $this->call(Oauth2ClientTypeSeeder::class);
        Model::reguard();
    }
}
