<?php namespace App\Controllers;

use App\Models\MakananModel;

class Galeri extends BaseController
{
    public function index()
    {
        $model = new MakananModel();

        // ambil semua makanan, urut terbaru dulu
        $data['items'] = $model->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'Galeri Kuliner';
        
        echo view('layout/header', $data);
        echo view('galeri', $data);
        echo view('layout/footer');
    }
}
