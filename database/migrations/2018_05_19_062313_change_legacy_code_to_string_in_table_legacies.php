<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLegacyCodeToStringInTableLegacies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legacies', function (Blueprint $table) {
            $table->string('legacy_code')->nullable()->change();
            $table->string('legacy_code_induk')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('legacies', function (Blueprint $table) {
            $table->string('legacy_code')->change();
            $table->string('legacy_code_induk')->change();
        });
    }
}
