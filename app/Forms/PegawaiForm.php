<?php

namespace App\Forms;
use App\FormasiJabatan;

use Kris\LaravelFormBuilder\Form;

class PegawaiForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('image', 'file', [
                'rules' => 'image'
            ])
            ->add('legacy_code', 'text', [
                'rules' => 'required'
            ])
            ->add('formasi_jabatan_id', 'entity', [
                'class' => 'App\FormasiJabatan',
                'property' => 'formasi', //Formasi - Jabatan 
                'query_builder' => function (FormasiJabatan $lang) {
                    // If query builder option is not provided, all data is fetched
                    return $lang->where('kode_olah','<>','000');
                }
            ])
			//Pada posisi
            ->add('perner', 'number', [
                'rules' => 'required'
            ])
            ->add('nip', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_pegawai', 'text', [
                'rules' => 'required'
            ])
            ->add('no_hp', 'text', [
                'rules' => ''
            ])
            ->add('email', 'text', [
                'rules' => ''
            ])
            ->add('kota_asal', 'text', [
                'rules' => ''
            ])
            ->add('status_domisili', 'text', [
                'rules' => ''
            ])
            ->add('employee_subgroup', 'text', [
                'rules' => ''
            ])
            ->add('ps_group', 'text', [
                'rules' => ''
            ])
            ->add('talent_pool_position', 'number', [
                'rules' => ''
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
            ->add('kali_jenjang', 'number', [
                'rules' => ''
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
