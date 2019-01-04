<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumTranslationExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('nombre_es');
            $table->dropColumn('nombre_en');
            $table->dropColumn('nombre_fr');
            $table->dropColumn('nombre_zh');
            $table->dropColumn('nombre_ru');
            $table->dropColumn('nombre_po');
            $table->dropColumn('descripcion_es');
            $table->dropColumn('descripcion_en');
            $table->dropColumn('descripcion_fr');
            $table->dropColumn('descripcion_zh');
            $table->dropColumn('descripcion_ru');
            $table->dropColumn('descripcion_po');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
