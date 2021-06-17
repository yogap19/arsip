<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table      = 'berkas';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'title', 'type', 'approved_Sadmin', 'approved_admin', 'organisasi', 'keterangan'];
}
