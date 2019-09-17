<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturnDateAndNotesFieldsToAnimalReclaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animal_reclaims', function (Blueprint $table) {
            $table->date('return_date')->nullable();
            $table->longText('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animal_reclaims', function (Blueprint $table) {
            $table->dropColumn('return_date');
            $table->dropColumn('notes');
        });
    }
}
