<?php

use Illuminate\Database\Seeder;
use App\ReservationType;

class ReservationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['adulto','niño'];
        foreach ($data as $type){
            ReservationType::create([
                'code' => $type
            ]);
        }

    }
}
