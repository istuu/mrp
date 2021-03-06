<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class DirektoratForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nama', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_pendek', 'number', [
                'rules' => 'required'
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
