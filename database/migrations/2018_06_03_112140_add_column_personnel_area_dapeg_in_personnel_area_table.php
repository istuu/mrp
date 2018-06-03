<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPersonnelAreaDapegInPersonnelAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personnel_area', function (Blueprint $table) {
            $table->string('personnel_area_dapeg')->after('id')->nullable();
            $table->string('sub_area_dapeg')->after('sub_area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personnel_area', function (Blueprint $table) {
            $table->dropColumn(['personnel_area_dapeg','sub_area_dapeg']);
        });
    }
}
