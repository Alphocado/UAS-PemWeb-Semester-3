<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ResepModel;
use App\Models\MakananModel;
use Config\Services;

class ResepController extends BaseController
{
    protected $session;
    protected $model;
    protected $makananModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = Services::session();
        $this->model = new ResepModel();
        $this->makananModel = new MakananModel();
    }

    protected function authOrRedirect()
    {
        if (! $this->session->get('is_admin')) {
            return redirect()->to('/login')->with('error','Silakan login.');
        }
        return null;
    }

    // Helper: build map makanan_id => ['nama'=>..., 'thumb'=>...]
    protected function buildMakananMap()
    {
        $all = $this->makananModel->findAll();
        $map = [];
        foreach ($all as $m) {
            $thumb = base_url('assets/img/placeholder.png');
            if (!empty($m['gambar'])) {
                $thumb = 'data:'.$m['mime_type'].';base64,'.base64_encode($m['gambar']);
            }
            $map[$m['id']] = ['nama' => $m['nama'], 'thumb' => $thumb];
        }
        return $map;
    }

    public function index()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $items = $this->model->orderBy('id','DESC')->findAll();
        $mMap = $this->buildMakananMap();

        $data = [
            'title' => 'Kelola Resep',
            'items' => $items,
            'makananMap' => $mMap
        ];

        echo view('layout/header', $data);
        echo view('admin/resep_list', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        if ($res = $this->authOrRedirect()) return $res;
        $data = [
            'title'=>'Tambah Resep',
            'makanan' => $this->makananModel->findAll()
        ];
        echo view('layout/header', $data);
        echo view('admin/resep_form', $data);
        echo view('layout/footer');
    }

    public function store()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $rules = [
            'makanan_id' => 'required|integer',
            'bahan' => 'required',
            'langkah' => 'required'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'makanan_id' => (int)$this->request->getPost('makanan_id'),
            'bahan' => $this->request->getPost('bahan'),
            'langkah' => $this->request->getPost('langkah'),
            'kategori' => $this->request->getPost('kategori'),
            'video_url' => $this->request->getPost('video_url'),
        ];

        try {
            $this->model->insert($data);
        } catch (\Exception $e) {
            log_message('error','Resep::store DB error - '.$e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/admin/resep')->with('message','Resep berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $item = $this->model->find($id);
        if (!$item) return redirect()->to('/admin/resep')->with('error','Data tidak ditemukan.');

        $data = [
            'title' => 'Edit Resep',
            'item' => $item,
            'makanan' => $this->makananModel->findAll()
        ];
        echo view('layout/header', $data);
        echo view('admin/resep_form', $data);
        echo view('layout/footer');
    }

    public function update($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $item = $this->model->find($id);
        if (!$item) return redirect()->to('/admin/resep')->with('error','Data tidak ditemukan.');

        $rules = [
            'makanan_id' => 'required|integer',
            'bahan' => 'required',
            'langkah' => 'required'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'makanan_id' => (int)$this->request->getPost('makanan_id'),
            'bahan' => $this->request->getPost('bahan'),
            'langkah' => $this->request->getPost('langkah'),
            'kategori' => $this->request->getPost('kategori'),
            'video_url' => $this->request->getPost('video_url'),
        ];

        try {
            $this->model->update($id, $data);
        } catch (\Exception $e) {
            log_message('error','Resep::update DB error - '.$e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/admin/resep')->with('message','Resep berhasil diupdate.');
    }

    public function delete($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $this->model->delete($id);
        return redirect()->to('/admin/resep')->with('message','Resep dihapus.');
    }
}
