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
        $this->call(ReservationTypeSeeder::class);
        $this->call(Oauth2ClientSeeder::class);
        $this->call(ConfigurationSeeder::class);
        Model::reguard();
    }
}
