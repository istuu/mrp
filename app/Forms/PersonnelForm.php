<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Direktorat;

class PersonnelForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('direktorat_id', 'entity', [
                'class' => 'App\Direktorat',
                'property' => 'nama',
            ])
            ->add('personnel_area', 'text', [
                'rules' => 'required'
            ])
            ->add('sub_area', 'text', [
                'rules' => 'required'
            ])
            ->add('personnel_area_dapeg', 'text', [
                'rules' => 'required'
            ])
            ->add('sub_area_dapeg', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_panjang', 'text', [
                'rules' => 'required'
            ])
            ->add('nama_pendek', 'text', [
                'rules' => 'required'
            ])
            ->add('username', 'text', [
                'rules' => 'required'
            ])
            // ->add('password', 'password', [
            //     'rules' => 'required'
            // ])
            ->add('alamat', 'textarea', [
                'rules' => 'required'
            ])
            ->add('kota', 'text', [
                'rules' => 'required'
            ])
            ->add('provinsi', 'text', [
                'rules' => 'required'
            ])
            ->add('submit', 'submit', [
                'label' => 'Simpan',
                'class' => 'btn btn-primary'
            ]);
    }
}
