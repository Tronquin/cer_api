<?php

use Illuminate\Database\Seeder;

class MachineUbicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubication = new \App\MachineUbication();
        $ubication->name = 'Sagrada Familia';
        $ubication->erp_ubication = 1;
        $ubication->save();
    }
}
