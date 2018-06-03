<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPersonnelAreaInPersonnelAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personnel_area', function (Blueprint $table) {
            $table->text('nama')->nullable()->change();
            $table->renameColumn('nama', 'nama_panjang');
            $table->string('personnel_area')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personnel_area', function (Blueprint $table) {
            $table->dropColumn('personnel_area');
            $table->renameColumn('nama_panjang', 'nama');
        });
    }
}
