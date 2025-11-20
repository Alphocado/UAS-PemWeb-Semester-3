<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SejarahModel;
use App\Models\MakananModel;
use Config\Services;

class SejarahController extends BaseController
{
    protected $session;
    protected $model;
    protected $makananModel;
    protected $allowedFields = ['makanan_id','isi','gambar','mime_type','sumber'];

    public function __construct()
    {
        helper(['form','url']);
        $this->session = Services::session();
        $this->model = new SejarahModel();
        $this->makananModel = new MakananModel();
    }

    protected function authOrRedirect()
    {
        if (! $this->session->get('is_admin')) {
            return redirect()->to('/login')->with('error','Silakan login.');
        }
        return null;
    }

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
        $data = ['title'=>'Kelola Sejarah','items'=>$items,'makananMap'=>$mMap];
        echo view('layout/header',$data);
        echo view('admin/sejarah_list',$data);
        echo view('layout/footer');
    }

    public function create()
    {
        if ($res = $this->authOrRedirect()) return $res;
        $data = ['title'=>'Tambah Sejarah','makanan'=>$this->makananModel->findAll()];
        echo view('layout/header',$data);
        echo view('admin/sejarah_form',$data); // form no-file
        echo view('layout/footer');
    }

    public function store()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $rules = [
            'makanan_id' => 'required|integer',
            'isi' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }

        $data = [
            'makanan_id' => (int)$this->request->getPost('makanan_id'),
            'isi' => $this->request->getPost('isi'),
            'sumber' => $this->request->getPost('sumber')
        ];

        try {
            $this->model->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Sejarah::store DB error - ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan server saat menyimpan data.');
        }

        return redirect()->to('/admin/sejarah')->with('message','Data sejarah tersimpan.');
    }



    public function edit($id=null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $item = $this->model->find(intval($id));
        if (!$item) return redirect()->to('/admin/sejarah')->with('error','Data tidak ditemukan.');
        $data = ['title'=>'Edit Sejarah','item'=>$item,'makanan'=>$this->makananModel->findAll()];
        echo view('layout/header',$data);
        echo view('admin/sejarah_form',$data);
        echo view('layout/footer');
    }

    public function update($id=null)
    {
        // mirror store but call update
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $item = $this->model->find($id);
        if (!$item) return redirect()->to('/admin/sejarah')->with('error','Data tidak ditemukan.');

        $rules = ['makanan_id' => 'required|integer','isi' => 'required'];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }

        $data = [
            'makanan_id' => (int)$this->request->getPost('makanan_id'),
            'isi' => $this->request->getPost('isi'),
            'sumber' => $this->request->getPost('sumber')
        ];

        try {
            $this->model->update($id, $data);
        } catch (\Exception $e) {
            log_message('error', 'Sejarah::update DB error - ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan server saat menyimpan data.');
        }

        return redirect()->to('/admin/sejarah')->with('message','Data sejarah berhasil diupdate.');
    }


    public function delete($id=null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $this->model->delete(intval($id));
        return redirect()->to('/admin/sejarah')->with('message','Data sejarah dihapus.');
    }
}
