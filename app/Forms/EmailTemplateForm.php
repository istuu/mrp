<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EmailTemplateForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('type', 'text', [
                'rules' => 'required',
            ])
            ->add('from_name', 'text', [
                'rules' => 'required'
            ])
            ->add('from_email', 'text', [
                'rules' => 'required'
            ])
            // ->add('cc', 'text', [
            //     // 'rules' => 'required'
            // ])
            // ->add('bcc', 'text', [
            //     // 'rules' => 'required'
            // ])
            ->add('subject', 'text', [
                'rules' => 'required'
            ])
            ->add('description', 'textarea', [
                'rules' => 'required',
                'id' => 'description'
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
