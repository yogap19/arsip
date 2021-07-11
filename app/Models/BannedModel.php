<?php

namespace App\Models;

use CodeIgniter\Model;

class BannedModel extends Model
{

    protected $table = 'banned';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'time', 'count'];
}
