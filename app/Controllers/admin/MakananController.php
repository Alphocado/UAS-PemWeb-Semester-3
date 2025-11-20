<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MakananModel;
use Config\Services;

class MakananController extends BaseController
{
    protected $session;
    protected $model;

    public function __construct()
    {
        helper(['form','url']);
        $this->session = Services::session();
        $this->model = new MakananModel();
    }

    protected function authOrRedirect()
    {
        if (! $this->session->get('is_admin')) {
            return redirect()->to('/login')->with('error','Silakan login.');
        }
        return null;
    }

    public function index()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $data = [
            'title' => 'Kelola Makanan',
            'items' => $this->model->orderBy('id','DESC')->findAll()
        ];

        echo view('layout/header', $data);
        echo view('admin/makanan_list', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $data = ['title'=>'Tambah Makanan'];
        echo view('layout/header', $data);
        echo view('admin/makanan_form', $data);
        echo view('layout/footer');
    }

    public function store()
    {
        if ($res = $this->authOrRedirect()) return $res;

        $rules = ['nama' => 'required|min_length[2]|max_length[100]'];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        // handle optional image
        $file = $this->request->getFile('gambar');
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $file->isValid()) {
                $err = $file->getErrorString() . ' (' . $file->getError() . ')';
                return redirect()->back()->withInput()->with('error', 'Upload gambar gagal: '.$err);
            }

            $allowed = ['image/jpeg','image/png','image/gif'];
            $mime = $file->getClientMimeType();
            if (! in_array($mime, $allowed)) {
                return redirect()->back()->withInput()->with('error','Tipe file tidak diperbolehkan. JPG/PNG/GIF saja.');
            }

            // ukuran max 3MB (atur sesuai kebutuhan)
            $maxBytes = 3 * 1024 * 1024;
            if ($file->getSize() > $maxBytes) {
                return redirect()->back()->withInput()->with('error','Ukuran file terlalu besar. Maks 3MB.');
            }

            $tmp = $file->getTempName();
            $binary = @file_get_contents($tmp);
            if ($binary === false) {
                return redirect()->back()->withInput()->with('error','Gagal membaca file sementara. Periksa permission server.');
            }

            $data['gambar'] = $binary;
            $data['mime_type'] = $mime;
        }

        try {
            $this->model->insert($data);
        } catch (\Exception $e) {
            log_message('error','Makanan::store DB error - '.$e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/admin/makanan')->with('message','Makanan berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $item = $this->model->find($id);
        if (!$item) return redirect()->to('/admin/makanan')->with('error','Data tidak ditemukan.');

        $data = ['title'=>'Edit Makanan','item'=>$item];
        echo view('layout/header', $data);
        echo view('admin/makanan_form', $data);
        echo view('layout/footer');
    }

    public function update($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $id = intval($id);
        $item = $this->model->find($id);
        if (!$item) return redirect()->to('/admin/makanan')->with('error','Data tidak ditemukan.');

        $rules = ['nama' => 'required|min_length[2]|max_length[100]'];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        // handle optional new image (replace if provided)
        $file = $this->request->getFile('gambar');
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $file->isValid()) {
                $err = $file->getErrorString() . ' (' . $file->getError() . ')';
                return redirect()->back()->withInput()->with('error', 'Upload gambar gagal: '.$err);
            }

            $allowed = ['image/jpeg','image/png','image/gif'];
            $mime = $file->getClientMimeType();
            if (! in_array($mime, $allowed)) {
                return redirect()->back()->withInput()->with('error','Tipe file tidak diperbolehkan. JPG/PNG/GIF saja.');
            }

            $maxBytes = 3 * 1024 * 1024;
            if ($file->getSize() > $maxBytes) {
                return redirect()->back()->withInput()->with('error','Ukuran file terlalu besar. Maks 3MB.');
            }

            $tmp = $file->getTempName();
            $binary = @file_get_contents($tmp);
            if ($binary === false) {
                return redirect()->back()->withInput()->with('error','Gagal membaca file sementara. Periksa permission server.');
            }

            $data['gambar'] = $binary;
            $data['mime_type'] = $mime;
        }

        try {
            $this->model->update($id, $data);
        } catch (\Exception $e) {
            log_message('error','Makanan::update DB error - '.$e->getMessage());
            return redirect()->back()->withInput()->with('error','Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/admin/makanan')->with('message','Data makanan diperbarui.');
    }

    public function delete($id = null)
    {
        if ($res = $this->authOrRedirect()) return $res;
        $this->model->delete(intval($id));
        return redirect()->to('/admin/makanan')->with('message','Data makanan dihapus.');
    }
}
