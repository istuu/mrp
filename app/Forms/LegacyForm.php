<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LegacyForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('kode_org_induk', 'number', [
                'rules' => 'required'
            ])
            ->add('kode_org', 'number', [
                'rules' => 'required'
            ])
            ->add('lookup', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_panjang', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_baru', 'text', [
                'rules' => ''
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
