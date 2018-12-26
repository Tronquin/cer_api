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
        $this->call(DeviceTypeSeeder::class);
        $this->call(Oauth2ClientSeeder::class);
        $this->call(ConfigurationSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(ComponentSeeder::class);
        $this->call(GallerySeeder::class);
        Model::reguard();
    }
}
