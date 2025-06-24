<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'komentar';
    protected $allowedFields = ['laptop_id', 'nama', 'isi'];
    protected $useTimestamps = true;
}
