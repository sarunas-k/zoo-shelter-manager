<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorProceduresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->date('date');
            $table->longText('notes');
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('procedure_type_id');
            $table->unsignedBigInteger('vet_id');
        });

        Schema::drop('animal_procedure');

        Schema::create('procedure_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
