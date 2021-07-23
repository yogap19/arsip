<?php

namespace App\Models;

use CodeIgniter\Model;

class BroadcastModel extends Model
{

    protected $table = 'broadcast';
    protected $useTimestamps = true;
    protected $allowedFields = ['subject', 'code', 'pesan', 'count', 'pengirim'];
}
