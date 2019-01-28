<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLanguagesIso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $language = \App\Language::query()->where('iso', 'al')->first();
        $language->iso = 'de';
        $language->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $language = \App\Language::query()->where('iso', 'de')->first();
        $language->iso = 'al';
        $language->save();
    }
}
