<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MakananModel;
use App\Models\SejarahModel;
use App\Models\ResepModel;
use Config\Services;

class Dashboard extends BaseController
{
    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;
    protected $makananModel;
    protected $sejarahModel;
    protected $resepModel;
    
    public function __construct()
    {
        helper(['url', 'form']);

        // Ambil instance session via Services supaya VSCode / static analyzer paham tipenya
        $this->session = Services::session();

        $this->makananModel = new MakananModel();
        $this->sejarahModel = new SejarahModel();
        $this->resepModel   = new ResepModel();

    }

    public function index()
    {
        // Cek autentikasi admin
        if (! $this->session->get('is_admin')) {
            // redirect aman ke login jika belum terautentikasi
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $data = [
            'title' => 'Dashboard Admin',
            'admin_name' => $this->session->get('admin_name') ?? $this->session->get('admin_user'),
            'total_makanan' => $this->makananModel->countAllResults(),
            'total_sejarah' => $this->sejarahModel->countAllResults(),
            'total_resep'   => $this->resepModel->countAllResults()
        ];

        echo view('layout/header', $data);
        echo view('admin/dashboard', $data);
        echo view('layout/footer');
    }
}
