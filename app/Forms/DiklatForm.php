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
            ->add('judul_diklat', 'text', [
                'rules' => 'required'
            ])
			->add('tanggal_mulai', 'date', [
                'rules' => 'required'
            ])
			->add('tanggal_selesai', 'date', [
                'rules' => 'required'
            ])
            ->add('tanggal_sertifikat', 'date', [
                'rules' => 'required'
            ])
			->add('kode_sertifikat', 'text', [
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
