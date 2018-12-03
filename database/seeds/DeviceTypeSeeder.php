<?php

use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deviceType = new \App\DeviceType();
        $deviceType->code = 'machine';
        $deviceType->save();

        $deviceType = new \App\DeviceType();
        $deviceType->code = 'web';
        $deviceType->save();

        $deviceType = new \App\DeviceType();
        $deviceType->code = 'app';
        $deviceType->save();
    }
}
