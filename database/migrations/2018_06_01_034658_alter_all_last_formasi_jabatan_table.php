<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\FormasiJabatan;
use App\PersonnelArea;

class AlterAllLastFormasiJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('formasi_jabatan');
        Schema::create('formasi_jabatan', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('kode_olah');
            $table->string('direktorat_id')->nullable();
            $table->string('personnel_area_id')->nullable();
            $table->string('level')->nullable();
            $table->string('kode_induk')->nullable();
            $table->string('kode_formasi_jabatan')->nullable();
            $table->string('formasi');
            $table->string('jabatan')->nullable();
            $table->integer('pagu');
            $table->string('hasil')->nullable();
            $table->string('kelas_unit')->nullable();
            $table->string('hgl')->nullable();
            $table->string('jenjang_main')->nullable();
            $table->string('jenjang_sub')->nullable();
            $table->string('posisi_pada_unit')->nullable();
            $table->string('profesi')->nullable();
            $table->string('kode_profesi')->nullable();
            $table->string('legacy_code')->nullable();
            $table->string('spfj')->nullable();
            $table->timestamps();
        });

        //insert Data
        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = '000';
        $forjab->legacy_code = '000';
        $forjab->posisi_pada_unit = 'Superadmin';
        $forjab->formasi ='Superadmin';
		//$forjab->jabatan ='Superadmin';
        $forjab->hgl ='Superadmin';
        $forjab->jenjang_main ='Superadmin';
        $forjab->jenjang_sub ='Superadmin';
        $forjab->pagu = 1;
        $forjab->level = 'KP';
        // $forjab->realisasi = 1;
        $forjab->spfj ='Superadmin';
        $forjab->personnel_area_id = PersonnelArea::where('user_role', 0)->first()->id;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITDAN-15166401.MA';
        $forjab->legacy_code = '15166401';
        $forjab->posisi_pada_unit = 'DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Kepala Divisi';
		//$forjab->jabatan ='Kepala Divisi';
        $forjab->hgl ='Perijinan dan Pertanahan';
        $forjab->jenjang_main ='MA';
        $forjab->jenjang_sub ='Manajemen Atas';
        $forjab->pagu = 1;
        $forjab->level = 'KP';
        // $forjab->realisasi = 1;
        $forjab->spfj ='0324.P/DIR/2016';
        $forjab->personnel_area_id = PersonnelArea::where('user_role', 1)->first()->id;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITDAN-151664020101.F04';
        $forjab->legacy_code = '15166401';
        $forjab->posisi_pada_unit = 'SUB BIDANG PENGADAAN 1 BIDANG PELAKSANA PENGADAAN I DIVISI PENGADAAN STRATEGIS DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Analyst';
		//$forjab->jabatan ='Analyst';
        $forjab->hgl ='Pengadaan';
        $forjab->jenjang_main ='04';
        $forjab->jenjang_sub ='Fungsional IV';
        $forjab->pagu = 5;
        $forjab->level = 'KP';
        // $forjab->realisasi = 2;
        $forjab->spfj ='0324.P/DIR/2016';
        $forjab->personnel_area_id = PersonnelArea::where('user_role', 1)->skip(1)->first()->id;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITREG-JBB-1516730101.MM';
        $forjab->legacy_code = '1516730101';
        $forjab->posisi_pada_unit = 'DIVISI PENGEMBANGAN REGIONAL JAWA BAGIAN BARAT DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Manajer Senior';
		//$forjab->jabatan ='Manajer Senior';
        $forjab->hgl ='Perencanaan dan Pengendalian Regional Jawa Bagian Barat';
        $forjab->jenjang_main ='MM';
        $forjab->jenjang_sub ='Manajemen Menengah';
        $forjab->pagu =5;
        $forjab->level ='KP';
        // $forjab->realisasi =1;
        $forjab->spfj ='0037.P/DIR/2016';
        $forjab->personnel_area_id = PersonnelArea::where('nama_pendek', 'DISJABAR')->first()->id;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITREG-JBB-151673010101.MD';
        $forjab->legacy_code = '151673010101';
        $forjab->posisi_pada_unit = 'BIDANG PERENCANAAN DAN PENGENDALIAN REGIONAL JAWA BAGIAN BARAT DIVISI PENGEMBANGAN REGIONAL JAWA BAGIAN BARAT DIREKTORAT BISNIS REGIONAL JAWA BAGIAN BARAT PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Deputi Manajer';
		//$forjab->jabatan ='Deputi Manajer';
        $forjab->hgl ='Perencanaan Regional';
        $forjab->jenjang_main ='MD';
        $forjab->jenjang_sub ='Manajemen Dasar';
        $forjab->pagu =1;
        $forjab->level ='UI';
        // $forjab->realisasi =1;
        $forjab->spfj ='0037.P/DIR/2016';
        $forjab->personnel_area_id = PersonnelArea::where('nama_pendek', 'DISJABAR')->first()->id;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITHCM-1516650301.MM';
        $forjab->legacy_code = '1516650301';
        $forjab->posisi_pada_unit = 'DIVISI PENGEMBANGAN TALENTA DIREKTORAT HUMAN CAPITAL MANAGEMENT PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Manajer Senior';
		//$forjab->jabatan ='Manajer Senior';
        $forjab->hgl ='Rekrutmen dan Seleksi';
        $forjab->jenjang_main ='MM';
        $forjab->jenjang_sub ='Manajemen Menengah';
        $forjab->pagu =1;
        $forjab->level ='KP';
        // $forjab->realisasi =1;
        $forjab->spfj ='0032.P/DIR/2017';
        $forjab->personnel_area_id = PersonnelArea::where('username', 'karir2')->first()->id;;
        $forjab->save();

        $forjab = new FormasiJabatan;
        $forjab->id = Uuid::generate();
        $forjab->kode_olah = 'DITHCM-151665030401.F05';
        $forjab->legacy_code = '151665030401';
        $forjab->posisi_pada_unit = 'SUB BIDANG PENGELOLAAN KARIR DAN TALENTA BIDANG PENGELOLAAN KARIR DAN TALENTA II DIVISI PENGEMBANGAN TALENTA DIREKTORAT HUMAN CAPITAL MANAGEMENT PT PLN (PERSERO) KANTOR PUSAT';
        $forjab->formasi ='Assistant Analyst';
		//$forjab->jabatan ='Assistant Analyst';
        $forjab->hgl ='Pengelolaan Karir';
        $forjab->jenjang_main ='05';
        $forjab->jenjang_sub ='Fungsional V';
        $forjab->pagu =1;
        $forjab->level ='KP';
        // $forjab->realisasi =1;
        $forjab->spfj ='0032.P/DIR/2017';
        $forjab->personnel_area_id = PersonnelArea::where('username', 'sdm')->first()->id;
        $forjab->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formasi_jabatan', function (Blueprint $table) {
            //
        });
    }
}
