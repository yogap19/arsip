<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'nama', 'telepon', 'gender', 'tmptLahir', 'tglLahir', 'rtrw', 'desa', 'kecamatan', 'kota', 'email', 'password', 'image', 'role_id', 'is_active', 'created_at'];
}
