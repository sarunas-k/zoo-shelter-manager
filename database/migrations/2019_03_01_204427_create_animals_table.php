<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthdate');
            $table->string('name');
            $table->unsignedBigInteger('chip_number');
            $table->string('list_number');
            $table->dateTime('intake_date');
            $table->enum('size', ['Small', 'Medium', 'Large', 'Very large']);
            $table->unsignedInteger('species_id');
            $table->unsignedInteger('living_area_id');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('call_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->boolean('is_neutered');
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
        Schema::dropIfExists('animals');
    }
}
