<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDiklatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_diklats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('jenis_nama');
            $table->date('tanggal_sertifikat');
            $table->string('nilai_grade');
            $table->string('nilai_angka');
            $table->string('hasil');
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
        Schema::dropIfExists('info_diklats');
    }
}
