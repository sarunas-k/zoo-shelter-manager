<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalAdoptionsAndAnimalFostersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_adoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('person_id');
            $table->date('adoption_date');
            $table->date('return_date')->nullable();
            $table->longText('notes');
            $table->timestamps();
        });

        Schema::create('animal_fosters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('person_id');
            $table->date('foster_start_date');
            $table->date('foster_end_date')->nullable();
            $table->longText('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_adoptions');
        Schema::dropIfExists('animal_fosters');
    }
}
