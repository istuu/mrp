<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FormationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('kode_olah', 'text', [
                'rules' => 'required'
            ])
            ->add('direktorat_id', 'text', [
                'rules' => ''
            ])
            ->add('personnel_area_id', 'text', [
                'rules' => ''
            ])
            ->add('level', 'text', [
                'rules' => ''
            ])
            ->add('kode_induk', 'text', [
                'rules' => ''
            ])
            ->add('kode_formasi_jabatan', 'text', [
                'rules' => ''
            ])
            ->add('formasi', 'text', [
                'rules' => 'required'
            ])
            ->add('jabatan', 'text', [
                'rules' => 'required'
            ])
            ->add('pagu', 'text', [
                'rules' => ''
            ])
            ->add('hasil', 'text', [
                'rules' => ''
            ])
            ->add('kelas_unit', 'text', [
                'rules' => ''
            ])
            ->add('hgl', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_main', 'text', [
                'rules' => ''
            ])
            ->add('jenjang_sub', 'text', [
                'rules' => ''
            ])
            ->add('posisi_pada_unit', 'text', [
                'rules' => ''
            ])
            ->add('profesi', 'text', [
                'rules' => ''
            ])
            ->add('kode_profesi', 'text', [
                'rules' => ''
            ])
            ->add('spfj', 'text', [
                'rules' => ''
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
