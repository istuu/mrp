<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class KeyForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('sequence', 'number', [
                'rules' => 'required'
            ])
            ->add('title', 'text', [
                'rules' => 'required'
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
