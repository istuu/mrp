<?php

namespace App\Forms;
use App\FormasiJabatan;
use App\PersonnelArea;

use Kris\LaravelFormBuilder\Form;

class PegawaiForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('image', 'file', [
                'rules' => 'image'
            ])
            ->add('perner', 'number', [
                'rules' => 'required'
            ])
            ->add('nip', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_pegawai', 'text', [
                'rules' => 'required'
            ])
            ->add('employee_group', 'text', [
                'rules' => ''
            ])
            ->add('employee_subgroup', 'text', [
                'rules' => ''
            ])
            ->add('ps_group', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_mgt', 'text', [
                'rules' => ''
            ])
            ->add('sgt', 'text', [
                'rules' => ''
            ])
            ->add('formasi_jabatan_id', 'entity', [
                'class' => 'App\FormasiJabatan',
                'property' => 'formasi', //Formasi - Jabatan
                'query_builder' => function (FormasiJabatan $lang) {
                    // If query builder option is not provided, all data is fetched
                    return $lang->where('kode_olah','<>','000');
                }
            ])
            ->add('legacy_code', 'text', [
                'rules' => 'required'
            ])
            ->add('talent_pool_position', 'text', [
                'rules' => ''
            ])
            ->add('company_code', 'text', [
                'rules' => ''
            ])
            ->add('personnel_area_id', 'entity', [
                'class' => 'App\PersonnelArea',
                'property' => 'nama_panjang', //Formasi - Jabatan
                'query_builder' => function (PersonnelArea $lang) {
                    // If query builder option is not provided, all data is fetched
                    return $lang->where('user_role','<>','0');
                }
            ])
            ->add('tanggal_grade', 'date', [
                'rules' => 'required|date'
            ])
            ->add('tanggal_lahir', 'date', [
                'rules' => 'required|date'
            ])
            ->add('tanggal_masuk', 'date', [
                'rules' => 'required|date'
            ])
            ->add('tanggal_capeg', 'date', [
                'rules' => 'required|date'
            ])
            ->add('tanggal_pegawai', 'date', [
                'rules' => 'required|date'
            ])
            ->add('start_date', 'date', [
                'rules' => 'required|date'
            ])
            ->add('end_date', 'date', [
                'rules' => 'required|date'
            ])
            ->add('email', 'text', [
                'rules' => 'email'
            ])
            ->add('telepon', 'text', [
                'rules' => ''
            ])
            ->add('kali_jenjang', 'number', [
                'rules' => ''
            ])
            ->add('lama_jabat_di_unit_terakhir', 'number', [
                'rules' => ''
            ])
            ->add('sisa_masa_kerja', 'number', [
                'rules' => ''
            ])
            ->add('masa_kerja', 'number', [
                'rules' => ''
            ])
            ->add('nama_panjang_posisi', 'text', [
                'rules' => ''
            ])
            ->add('pada_posisi', 'text', [
                'rules' => ''
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
