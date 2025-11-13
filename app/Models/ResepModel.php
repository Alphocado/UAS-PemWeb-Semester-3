<?php namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'makanan_id', 'bahan', 'langkah', 'gambar', 'video_url', 'kategori'
    ];

    public function getLatest($limit = 4)
    {
        return $this->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    public function search($q = null)
    {
        if (!$q) return $this->orderBy('id', 'DESC')->findAll();
        return $this->like('bahan', $q)
                    ->orLike('langkah', $q)
                    ->orLike('kategori', $q)
                    ->findAll();
    }

    public function getAllWithMakanan()
    {
        return $this->select('resep.*, makanan.nama AS nama_makanan')
                    ->join('makanan', 'makanan.id = resep.makanan_id')
                    ->orderBy('makanan.nama', 'ASC')
                    ->findAll();
    }

    public function getById($id)
    {
        return $this->select('resep.*, makanan.nama AS nama_makanan')
                    ->join('makanan', 'makanan.id = resep.makanan_id')
                    ->where('resep.id', $id)
                    ->first();
    }
}
