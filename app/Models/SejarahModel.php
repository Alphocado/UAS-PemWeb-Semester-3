<?php namespace App\Models;

use CodeIgniter\Model;

class SejarahModel extends Model
{
    protected $table = 'sejarah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'makanan_id', 'isi', 'gambar', 'sumber'
    ];

    public function getAllWithMakanan()
    {
        return $this->select('sejarah.*, makanan.nama AS nama_makanan')
                    ->join('makanan', 'makanan.id = sejarah.makanan_id')
                    ->orderBy('makanan.nama', 'ASC')
                    ->findAll();
    }

    public function getById($id)
    {
        return $this->select('sejarah.*, makanan.nama AS nama_makanan')
                    ->join('makanan', 'makanan.id = sejarah.makanan_id')
                    ->where('sejarah.id', $id)
                    ->first();
    }
}
