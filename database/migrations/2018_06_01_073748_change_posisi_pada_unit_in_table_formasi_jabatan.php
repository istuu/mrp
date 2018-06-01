<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePosisiPadaUnitInTableFormasiJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formasi_jabatan', function (Blueprint $table) {
            $table->text('posisi_pada_unit')->nullable()->change();
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
            $table->string('posisi_pada_unit')->nullable();
        });
    }
}
