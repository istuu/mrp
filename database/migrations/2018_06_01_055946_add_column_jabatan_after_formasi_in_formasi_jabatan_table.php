<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnJabatanAfterFormasiInFormasiJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formasi_jabatan', function (Blueprint $table) {
            //$table->string('jabatan')->after('formasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formasi_jabatan', function (Blueprint $table) {
            //$table->dropColumn(['jabatan']);
        });
    }
}
