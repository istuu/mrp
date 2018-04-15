<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_org');
            $table->string('kode_olah');
            $table->integer('urut');
            $table->string('direktorat');
            $table->string('personnel_area');
            $table->string('level')->nullable();
            $table->string('formasi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kelas_unit')->nullable();
            $table->string('jenjang_main')->nullable();
            $table->string('jenjang_sub')->nullable();
            $table->text('posisi_unit')->nullable();
            $table->string('kode_profesi')->nullable();
            $table->string('jenis')->nullable();
            $table->string('hitung')->nullable();
            $table->string('revisi')->nullable();
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
        Schema::dropIfExists('formations');
    }
}
