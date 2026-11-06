<?php

namespace App\Models;
use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'data_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nis', 'tanggal_lahir', 'asal'];
    protected $useTimestamps = true;
}