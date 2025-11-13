<?php namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 'deskripsi', 'gambar', 'kategori', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByKategori($kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }
}
