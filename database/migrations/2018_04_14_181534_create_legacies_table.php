<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legacies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_org_induk');
            $table->integer('kode_org');
            $table->text('lookup');
            $table->text('nama_panjang')->nullable();
            $table->text('nama_baru')->nullable();
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
        Schema::dropIfExists('legacies');
    }
}
