<?php

use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $component = new \App\Component();
        $component->code = 'scan';
        $component->name = 'Scan';
        $component->save();

        $component = new \App\Component();
        $component->code = 'dispenser';
        $component->name = 'Dispensador de llave';
        $component->save();

        $component = new \App\Component();
        $component->code = 'tpv';
        $component->name = 'TPV';
        $component->save();
    }
}
