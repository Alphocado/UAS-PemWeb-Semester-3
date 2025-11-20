<?php namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table      = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul','deskripsi','kategori','gambar','mime_type','uploader'];
    protected $returnType = 'array';
}
