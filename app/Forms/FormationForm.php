<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FormationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('kode_org', 'number', [
                'rules' => 'required'
            ])
            ->add('kode_olah', 'number', [
                'rules' => 'required'
            ])
            ->add('urut', 'text', [
                'rules' => 'required'
            ])
            ->add('direktorat', 'text', [
                'rules' => 'required'
            ])
            ->add('personnel_area', 'text', [
                'rules' => 'required'
            ])
            ->add('level', 'text', [
                'rules' => ''
            ])
            ->add('formasi', 'text', [
                'rules' => 'required'
            ])
            ->add('jabatan', 'text', [
                'rules' => ''
            ])
            ->add('kelas_unit', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_main', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_sub', 'text', [
                'rules' => ''
            ])
            ->add('posisi_unit', 'text', [
                'rules' => ''
            ])
            ->add('kode_profesi', 'text', [
                'rules' => ''
            ])
            ->add('jenis', 'text', [
                'rules' => ''
            ])
            ->add('hitung', 'text', [
                'rules' => ''
            ])
            ->add('revisi', 'text', [
                'rules' => ''
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
