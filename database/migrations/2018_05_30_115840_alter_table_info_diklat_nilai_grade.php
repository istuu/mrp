<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableInfoDiklatNilaiGrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_diklats', function (Blueprint $table) {
            $table->dropColumn('nilai_grade');
			$table->string('kelompok_prestasi')->after('kode_sertifikat')->nullable();
			$table->string('nilai_angka')->nullable()->change();
			$table->string('hasil')->nullable()->change();
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
            $table->string('nilai_grade')->after('kode_sertifikat');
			$table->dropColumn('kelompok_prestasi');
			$table->string('nilai_angka')->change();
			$table->string('hasil')->change();
        });
    }
}
