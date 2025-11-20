<?php namespace App\Models;

use CodeIgniter\Model;

class MakananModel extends Model
{
    protected $table      = 'makanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama','gambar','mime_type'];
    protected $returnType = 'array';

    public function getAll()
    {
        return $this->orderBy('nama', 'ASC')->findAll();
    }

    public function getById($id)
    {
        return $this->where('id', $id)->first();
    }
}
