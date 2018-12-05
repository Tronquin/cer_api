<?php

use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine = new \App\Machine();
        $machine->public_id = uniqid('MAC-');
        $machine->description = 'Maquina Sagrada Familia';
        $machine->machine_ubication_id = \App\MachineUbication::query()->first()->id;
        $machine->save();

        $components = \App\Component::all();

        foreach ($components as $component) {
            $machine->components()->attach($component, ['active' => true]);
        }
    }
}
