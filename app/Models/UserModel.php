<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'nama', 'telepon', 'gender', 'tmptLahir', 'tglLahir', 'rtrw', 'desa', 'kecamatan', 'kota', 'email', 'password', 'image', 'role_id', 'is_active', 'created_at', 'pin'];

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

    // chart user tahunan
    public function Si($tahun)
    {
        return $this->table('user')->like('nim', '35' . $tahun);
    }
    public function Ti($tahun)
    {
        return $this->table('user')->like('nim', '36' . $tahun);
    }
    public function Ak($tahun)
    {
        return $this->table('user')->like('nim', '37' . $tahun);
    }
    public function Mn($tahun)
    {
        return $this->table('user')->like('nim', '38' . $tahun);
    }
    public function mi3($tahun)
    {
        return $this->table('user')->like('nim', '25' . $tahun);
    }
    public function ti3($tahun)
    {
        return $this->table('user')->like('nim', '25' . $tahun);
    }
    public function ak3($tahun)
    {
        return $this->table('user')->like('nim', '25' . $tahun);
    }
    public function mn3($tahun)
    {
        return $this->table('user')->like('nim', '28' . $tahun);
    }
}
