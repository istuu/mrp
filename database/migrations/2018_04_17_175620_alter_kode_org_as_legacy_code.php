<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKodeOrgAsLegacyCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->renameColumn('kode_org', 'legacy_code');
        });
        Schema::table('legacies', function (Blueprint $table) {
            $table->renameColumn('kode_org_induk', 'legacy_code_induk');
            $table->renameColumn('kode_org', 'legacy_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->renameColumn('legacy_code','kode_org');
        });
        Schema::table('legacies', function (Blueprint $table) {
            $table->renameColumn('legacy_code_induk','kode_org_induk');
            $table->renameColumn('legacy_code','kode_org');
        });
    }
}
