<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntakeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intake_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::table('animals', function (Blueprint $table) {
            $table->unsignedInteger('intake_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intake_types');
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('intake_type_id');
        });
    }
}
