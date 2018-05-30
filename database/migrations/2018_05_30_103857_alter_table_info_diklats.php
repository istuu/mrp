<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableInfoDiklats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_diklats', function (Blueprint $table) {
            $table->dropColumn('jenis_nama');
			$table->string('judul_diklat')->after('nip')->nullable();
			$table->string('tanggal_mulai')->after('judul_diklat')->nullable();
			$table->string('tanggal_selesai')->after('tanggal_mulai')->nullable();
			$table->string('kode_sertifikat')->after('tanggal_sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('info_diklats', function (Blueprint $table) {
            $table->string('jenis_nama')->after('nip');
			$table->dropColumn(['judul_diklat','tanggal_mulai','tanggal_selesai','kode_sertifikat']);
        });
    }
}
