<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBringInPersonIdFieldToAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->unsignedInteger('bring_in_person_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('bring_in_person_id');
        });
    }
}
