<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFormasiJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formasi_jabatan', function (Blueprint $table) {
            $table->text('kode_olah')->change();
            $table->text('posisi')->nullable()->change();
            $table->string('level')->nullable()->change();
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
            $table->string('kode_olah')->change();
            $table->string('posisi')->change();
            $table->string('level')->change();
        });
    }
}
