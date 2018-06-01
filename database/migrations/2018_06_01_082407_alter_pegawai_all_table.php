<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPegawaiAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pegawai');
        Schema::create('pegawai', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('perner');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('employee_group')->nullable();
            $table->string('employee_subgroup')->nullable();
            $table->string('ps_group')->nullable();
            $table->string('jenjang_mgid')->nullable();
            $table->string('jenjang_mgt')->nullable();
            $table->string('jenjang_sgid')->nullable();
            $table->string('jenjang_sgt')->nullable();
            $table->string('formasi_jabatan_id')->nullable();
            $table->string('legacy_code')->nullable();
            $table->string('talent_pool_position')->nullable();
            $table->string('company_code')->nullable();
            $table->string('personnel_area_id')->nullable();
            $table->date('tanggal_grade')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_capeg')->nullable();
            $table->date('tanggal_pegawai')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('kali_jenjang')->nullable();
            $table->string('lama_jenjang')->nullable();
            $table->string('lama_jabat_di_unit_terakhir')->nullable();
            $table->string('sisa_masa_kerja')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            //
        });
    }
}
