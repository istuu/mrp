<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStgInTableSk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_stg', function (Blueprint $table) {
            $table->string('no_dokumen_kirim_stg')->after('no_stg');
            $table->string('tahun_stg')->after('no_stg');
            $table->string('filename_dokumen_stg')->after('no_dokumen_kirim_stg');
            $table->date('tgl_kirim_stg')->after('filename_dokumen_stg');
            $table->date('tgl_aktivasi_stg')->after('tgl_kirim_stg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sk_stg', function (Blueprint $table) {
            $table->dropColumn(['no_dokumen_kirim_stg','tahun_stg','filename_dokumen_stg','tgl_kirim_stg','tgl_aktivasi_stg']);
        });
    }
}
