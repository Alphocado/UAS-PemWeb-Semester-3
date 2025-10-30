<?php namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();
        echo view('layout/header', $data);
        echo view('mahasiswa/index', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        $model = new MahasiswaModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan')
        ]);
        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->find($id);
        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();
        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan')
        ]);
        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);
        return redirect()->to('/mahasiswa');
    }
}
