<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\Status();
        $type->code = 'pendiente';
        $type->save();

        $type = new \App\Status();
        $type->code = 'checkin';
        $type->save();

        $type = new \App\Status();
        $type->code = 'checkout';
        $type->save();
    }
}
