<?php namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'email', 'subjek', 'isi_pesan', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
