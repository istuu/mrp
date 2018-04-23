<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FormationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('legacy_code', 'text', [
                'rules' => 'required'
            ])
            ->add('kode_olah', 'text', [
                'rules' => 'required'
            ])
            // ->add('urut', 'text', [
            //     'rules' => 'required'
            // ])
            // ->add('direktorat', 'text', [
            //     'rules' => 'required'
            // ])
            ->add('level', 'text', [
                'rules' => ''
            ])
            ->add('posisi', 'text', [
                'rules' => ''
            ])
            ->add('kelas_unit', 'text', [
                'rules' => ''
            ])
            ->add('hgl', 'text', [
                'rules' => ''
            ])
            ->add('formasi', 'text', [
                'rules' => 'required'
            ])
            ->add('jabatan', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_id', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_txt', 'text', [
                'rules' => ''
            ])
            ->add('pagu', 'number', [
                'rules' => ''
            ])
            ->add('spfj', 'text', [
                'rules' => ''
            ])
            ->add('status_fj', 'text', [
                'rules' => ''
            ])
            ->add('personnel_area_id', 'text', [
                'label' => 'Personnel Area',
                'rules' => 'required'
            ])
            // ->add('kode_profesi', 'text', [
            //     'rules' => ''
            // ])
            // ->add('jenis', 'text', [
            //     'rules' => ''
            // ])
            // ->add('hitung', 'text', [
            //     'rules' => ''
            // ])
            // ->add('revisi', 'text', [
            //     'rules' => ''
            // ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
