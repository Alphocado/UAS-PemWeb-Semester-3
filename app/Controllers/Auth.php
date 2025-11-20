<?php namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper(['form', 'url', 'cookie']);
    }

    // Tampilkan form login
    public function login()
    {
        // jika sudah login, redirect ke admin
        $session = session();
        if ($session->get('is_admin')) {
            return redirect()->to('/admin');
        }

        echo view('layout/header', ['title' => 'Login Admin']);
        echo view('admin/login');   // view yang akan kita buat
        echo view('layout/footer');
    }

    // Proses login (POST)
    public function attempt()
    {
        $session = session();
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[1]|max_length[255]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->adminModel->findByUsername($username);

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        // === PERSAMAAN PLAIN (development) ===
        // bandingkan langsung string password (pastikan DB menyimpan plaintext dulu)
        if ($password !== $user['password']) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        // sukses: regenerate session id untuk mencegah fixation
        $session->regenerate();

        $session->set([
            'is_admin'    => true,
            'admin_id'    => $user['id'],
            'admin_user'  => $user['username'],
            'admin_name'  => $user['nama_lengkap'],
            'logged_in_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin')->with('message', 'Login berhasil. Selamat datang!');
    }


    // Logout
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('message', 'Anda sudah logout.');
    }
}
