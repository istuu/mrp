<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class DiklatForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nip', 'text', [
                'rules' => 'required'
            ])
            ->add('jenis_nama', 'text', [
                'rules' => 'required'
            ])
            ->add('tanggal_sertifikat', 'date', [
                'rules' => 'required'
            ])
            ->add('nilai_grade', 'text', [
                'rules' => 'required'
            ])
            ->add('nilai_angka', 'text', [
                'rules' => 'required'
            ])
            ->add('hasil', 'text', [
                'rules' => 'required'
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
