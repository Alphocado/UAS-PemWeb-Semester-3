<?php namespace App\Controllers;

use App\Models\MakananModel;
use App\Models\ResepModel;
use App\Models\SejarahModel;

class Home extends BaseController
{
    protected $makananModel;
    protected $resepModel;
    protected $sejarahModel;

    public function __construct()
    {
        $this->makananModel = new MakananModel();
        $this->resepModel   = new ResepModel();
        $this->sejarahModel = new SejarahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'featured' => $this->resepModel->getLatest(4),
        ];
        echo view('layout/header', $data);
        echo view('home', $data);
        echo view('layout/footer');
    }

    public function sejarah()
    {
        $data = [
            'title' => 'Sejarah Kuliner Makassar',
            'list'  => $this->sejarahModel->getAllWithMakanan(),
        ];
        echo view('layout/header', $data);
        echo view('sejarah', $data);
        echo view('layout/footer');
    }

    public function sejarahDetail($id = null)
    {
        $id = intval($id);
        if (!$id) return redirect()->to('/sejarah');

        $item = $this->sejarahModel->getById($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Konten sejarah tidak ditemukan");
        }

        $data = [
            'title' => 'Sejarah - ' . ($item['nama_makanan'] ?? 'Sejarah'),
            'item'  => $item
        ];
        echo view('layout/header', $data);
        echo view('detail_sejarah', $data);
        echo view('layout/footer');
    }


    public function resep()
    {
        $q = $this->request->getGet('q');
        $data = [
            'title' => 'Daftar Resep',
            'recipes' => $this->resepModel->search($q),
            'q' => $q
        ];
        echo view('layout/header', $data);
        echo view('resep', $data);
        echo view('layout/footer');
    }
    
    public function resepDetail($id = null)
    {
        $id = intval($id);
        if (!$id) return redirect()->to('/resep');

        $recipe = $this->resepModel->getById($id);
        if (!$recipe) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Resep tidak ditemukan");
        }

        $data = [
            'title' => 'Detail Resep - ' . ($recipe['nama_makanan'] ?? 'Resep'),
            'recipe' => $recipe
        ];
        echo view('layout/header', $data);
        echo view('detail_resep', $data);
        echo view('layout/footer');
    }
    
    public function galeri()
    {
        echo view('layout/header', ['title' => 'Galeri']);
        echo view('galeri');
        echo view('layout/footer');
    }

    public function login()
    {
        echo view('layout/header', ['title' => 'Login']);
        echo view('admin/login'); // nanti buat view admin/login
        echo view('layout/footer');
    }
    // detail untuk resep

    
    public function imgResep($id = null)
    {
        $id = intval($id);
        if (!$id) return $this->response->setStatusCode(404);

        $row = $this->resepModel->where('id', $id)->first();
        if (!$row) return $this->response->setStatusCode(404);

        // kalau kolom gambar berisi binary blob
        $blob = $row['gambar'];
        if (empty($blob)) return $this->response->setStatusCode(404);

        // detect mime type
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($blob) ?: 'image/jpeg';

        return $this->response->setHeader('Content-Type', $mime)
                              ->setBody($blob);
    }

    public function imgSejarah($id = null)
    {
        $id = intval($id);
        if (!$id) return $this->response->setStatusCode(404);

        $row = $this->sejarahModel->where('id', $id)->first();
        if (!$row) return $this->response->setStatusCode(404);

        $blob = $row['gambar'];
        if (empty($blob)) return $this->response->setStatusCode(404);

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($blob) ?: 'image/jpeg';

        return $this->response->setHeader('Content-Type', $mime)
                              ->setBody($blob);
    }

}
