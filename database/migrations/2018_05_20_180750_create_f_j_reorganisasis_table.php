<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFJReorganisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_j_reorganisasis', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('kode_olah');
            $table->string('legacy_code')->nullable();
            $table->string('level');
            $table->string('posisi');
            $table->string('kelas_unit')->nullable();
            $table->string('hgl')->nullable();
            $table->string('formasi');
            $table->string('jabatan');
            $table->string('jenjang_id');
            $table->string('jenjang_txt');
            $table->integer('pagu');
            $table->string('spfj')->nullable();
            $table->string('status_fj')->nullable();

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
        Schema::dropIfExists('f_j_reorganisasis');
    }
}
