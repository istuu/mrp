<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnNamaBaruInTableFormasiJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legacies', function (Blueprint $table) {
            $table->dropColumn('nama_baru');
            $table->string('nama_singkat')->after('nama_panjang');
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
            $table->dropColumn('nama_singkat');
            $table->string('nama_baru')->after('nama_panjang');
        });
    }
}
