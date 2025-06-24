<?php

namespace App\Models;

use CodeIgniter\Model;

class LaptopModel extends Model
{
    protected $table      = 'laptops';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'spesifikasi', 'harga', 'gambar','stok'];
    protected $useTimestamps = false;
}
