<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table      = 'penjualan';
    protected $primaryKey = 'id';

    protected $allowedFields = ['laptop_id', 'nama_laptop', 'harga', 'tanggal', 'jumlah', 'total_harga'];

}
