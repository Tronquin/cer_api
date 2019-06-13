<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitColumnOrderSpaSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $SpaSections = \App\SpaSection::all();
        $order = 0;
        foreach ($SpaSections as $SpaSection) {
            $SpaSection->order = ++$order;
            $SpaSection->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $SpaSections = \App\SpaSection::all();
        $order = 0;
        foreach ($SpaSections as $SpaSection) {
            $SpaSection->order = null;
            $SpaSection->save();
        }
    }
}
