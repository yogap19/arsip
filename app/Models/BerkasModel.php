<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table      = 'berkas';
    protected $useTimestamps = true;
    protected $allowedFields = ['nim', 'title', 'type', 'approved_Sadmin', 'approved_admin', 'organisasi', 'nik', 'jurusan', 'keterangan', 'keteranganA', 'keteranganS'];

    public function berkas($search)
    {
        return $this->table('berkas')->like('nim', $search)->orLike('updated_at', date('Y'))
            ->orLike('title', $search)->orLike('updated_at', $search)
            ->orLike('keterangan', $search)->orLike('keteranganA', $search)
            ->orLike('keteranganS', $search)->orderBy('updated_at', 'DESC');
    }

    public function beasiswa($years)
    {
        return $this->table('berkas')->join('user', 'user.nim = berkas.nim')
            ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
            ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
            ->where('berkas.type = 3')->like('berkas.updated_at', $years)->get()->getResultArray();
    }
}
