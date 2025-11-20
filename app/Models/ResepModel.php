<?php namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table      = 'resep';
    protected $primaryKey = 'id';
    protected $allowedFields = ['makanan_id','bahan','langkah','video_url','kategori'];
    protected $returnType = 'array';

    public function getLatest($limit = 4)
    {
        return $this->orderBy('id', 'DESC')->limit($limit)->findAll();
    }

    public function search($q = null)
    {
        $builder = $this->select('resep.*, makanan.nama AS nama_makanan, makanan.gambar AS gambar_makanan, makanan.mime_type AS mime_makanan')
                        ->join('makanan', 'makanan.id = resep.makanan_id');

        if ($q) {
            $builder->like('bahan', $q)
                    ->orLike('langkah', $q)
                    ->orLike('kategori', $q);
        }

        return $builder->orderBy('makanan.nama', 'ASC')->findAll();
    }

    public function getAllWithMakanan()
    {
        return $this->select('resep.*, makanan.nama AS nama_makanan, makanan.gambar AS gambar_makanan, makanan.mime_type AS mime_makanan')
                    ->join('makanan', 'makanan.id = resep.makanan_id')
                    ->orderBy('makanan.nama', 'ASC')
                    ->findAll();
    }

    public function getById($id)
    {
        return $this->select('resep.*, makanan.nama AS nama_makanan, makanan.gambar AS gambar_makanan, makanan.mime_type AS mime_makanan')
                    ->join('makanan', 'makanan.id = resep.makanan_id')
                    ->where('resep.id', $id)
                    ->first();
    }
}
