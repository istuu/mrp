<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTglAktivasiDisetujuiNCatatanInMrpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mrp', function (Blueprint $table) {
            $table->date('tanggal_aktivasi_disetujui')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mrp', function (Blueprint $table) {
            $table->dropColumn(['tanggal_aktivasi_disetujui','catatan']);
        });
    }
}
