<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsInAdoptionsAndFostersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animal_adoptions', function (Blueprint $table) {
            $table->date('return_date')->nullable()->change();
        });

        Schema::table('animal_fosters', function (Blueprint $table) {
            $table->date('foster_end_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animal_adoptions', function (Blueprint $table) {
            $table->date('return_date')->nullable(false)->change();
        });

        Schema::table('animal_fosters', function (Blueprint $table) {
            $table->date('foster_end_date')->nullable(false)->change();
        });
    }
}
