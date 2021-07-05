<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'nama', 'telepon', 'gender', 'tmptLahir', 'tglLahir', 'rtrw', 'desa', 'kecamatan', 'kota', 'email', 'password', 'image', 'role_id', 'is_active', 'created_at'];

    public function user($search)
    {
        return $this->table('user')->like('nim', $search)
            ->orLike('nama', $search)->orLike('updated_at', $search)
            ->orLike('kota', $search)->orLike('tglLahir', $search);
    }
    public function akun($search)
    {
        return $this->table('user')->like('nim', $search)
            ->orLike('nama', $search)->orLike('telepon', $search)->orLike('email', $search);
    }
}
