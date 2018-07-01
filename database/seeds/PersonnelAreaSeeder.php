<?php

use Illuminate\Database\Seeder;
use App\PersonnelArea;
use App\Direktorat;

class PersonnelAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Superadmin
        if(PersonnelArea::where('user_role',0)->count() < 1){
            $user = new PersonnelArea;
            $user->id = Uuid::generate();
            $user->personnel_area = 'Superadmin';
            $user->nama_panjang = 'Superadmin';
            $user->sub_area = 'Superadmin';
            $user->nama_pendek = 'Superadmin';
            $user->username = 'superadmin';
            $user->password = bcrypt('superadmin');
            $user->direktorat_id = Direktorat::first()->id;
            $user->user_role = 0;
            $user->save();
        }

        if(PersonnelArea::where('user_role',2)->count() < 1){
            $user = new PersonnelArea;
            $user->id = Uuid::generate();
            $user->personnel_area = 'Karir1';
            $user->nama_panjang = 'Karir1';
            $user->sub_area = 'Karir1';
            $user->nama_pendek = 'Karir1';
            $user->username = 'karir1';
            $user->password = bcrypt('karir1');
            $user->direktorat_id = Direktorat::first()->id;
            $user->user_role = 2;
            $user->save();
        }

        if(PersonnelArea::where('user_role',3)->count() < 1){
            $user = new PersonnelArea;
            $user->id = Uuid::generate();
            $user->personnel_area = 'Karir2';
            $user->nama_panjang = 'Karir2';
            $user->sub_area = 'Karir2';
            $user->nama_pendek = 'Karir2';
            $user->username = 'karir2';
            $user->password = bcrypt('karir2');
            $user->direktorat_id = Direktorat::first()->id;
            $user->user_role = 3;
            $user->save();
        }

        if(PersonnelArea::where('user_role',4)->count() < 1){
            $user = new PersonnelArea;
            $user->id = Uuid::generate();
            $user->personnel_area = 'KarirKP';
            $user->nama_panjang = 'KarirKP';
            $user->sub_area = 'KarirKP';
            $user->nama_pendek = 'KarirKP';
            $user->username = 'karirkp';
            $user->password = bcrypt('karirkp');
            $user->direktorat_id = Direktorat::first()->id;
            $user->user_role = 4;
            $user->save();
        }

    //     // unit
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'DIVISI PERIZINAN DAN PERTANAHAN DIREKTORAT PENGADAAN';
    //     $user->nama_pendek = 'DIVPPT';
    //     $user->username = 'divppt1';
    //     $user->password = bcrypt('divppt');
    //     $user->direktorat_id = Direktorat::first()->id;
    //     $user->user_role = 1;
    //     $user->save();
    //
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'DIVISI PENGADAAN STRATEGIS DIREKTORAT PENGADAAN PT PLN (PERSERO) KANTOR PUSAT';
    //     $user->nama_pendek = 'DIVDAS';
    //     $user->username = 'divdas';
    //     $user->password = bcrypt('divdas');
    //     $user->direktorat_id = Direktorat::first()->id;
    //     $user->user_role = 1;
    //     $user->save();
    //
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'DISTRIBUSI JAWA BARAT';
    //     $user->nama_pendek = 'DISJABAR';
    //     $user->username = 'disjabar';
    //     $user->password = bcrypt('disjabar');
    //     $user->direktorat_id = Direktorat::where('nama_pendek', 'DITREG-JBB')->first()->id;
    //     $user->user_role = 1;
    //     $user->save();
    //
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'DIVISI PENGEMBANGAN TALENTA';
    //     $user->nama_pendek = 'DIVTLN';
    //     $user->username = 'divtln';
    //     $user->password = bcrypt('divtln');
    //     $user->direktorat_id = Direktorat::skip(1)->first()->id;
    //     $user->user_role = 1;
    //     $user->save();
    //
    //     // SDM
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'SDM';
    //     $user->nama_pendek = 'SDM';
    //     $user->username = 'sdm';
    //     $user->password = bcrypt('sdm');
    //     $user->direktorat_id = Direktorat::skip(2)->first()->id;
    //     $user->user_role = 3;
    //     $user->save();
    //
    //     // karir2
    //     $user = new PersonnelArea;
    //     $user->id = Uuid::generate();
    //     $user->nama = 'Karir 2';
    //     $user->nama_pendek = 'Karir 2';
    //     $user->username = 'karir2';
    //     $user->password = bcrypt('karir2');
    //     $user->direktorat_id = Direktorat::skip(3)->first()->id;
    //     $user->user_role = 2;
    //     $user->save();
    }
}
