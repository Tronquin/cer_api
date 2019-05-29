<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitExtraOustandingOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $extras = \App\ExtraOustanding::all();
        $order = 0;
        foreach ($extras as $extra) {
            $extra->order = ++$order;
            $extra->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $extras = \App\ExtraOustanding::all();
        foreach ($extras as $extra) {
            $extra->order = null;
            $extra->save();
        }
    }
}
