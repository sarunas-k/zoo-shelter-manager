<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caller_name');
            $table->string('caller_phone');
            $table->string('address');
            $table->text('info');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('staff_id');
            $table->enum('status', ['Waiting', 'On hold', 'Finished']);
            $table->timestamps();
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->boolean('is_vet');
        });

        Schema::create('living_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('breeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
        });

        Schema::create('procedure_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('procedures', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->longText('notes');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('procedure_type_id');
            $table->unsignedBigInteger('vet_id');
        });

        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('phone_first');
            $table->string('phone_second');
            $table->string('address');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
        Schema::dropIfExists('calls');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('living_areas');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('breeds');
        Schema::dropIfExists('images');
        Schema::dropIfExists('procedures');
        Schema::dropIfExists('animal_procedure');
        Schema::dropIfExists('people');
        Schema::dropIfExists('settings');
        
    }
}
