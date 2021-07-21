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
        return $this->table('berkas')->where(['approved_admin' => 1])->like('nim', $search)
            ->orLike('title', $search)->orLike('updated_at', $search)
            ->orLike('keterangan', $search)->orLike('keteranganA', $search)
            ->orLike('keteranganS', $search)->orLike('organisasi', $search);
    }

    // excel request
    public function beasiswa($years)
    {
        return $this->table('berkas')->join('user', 'user.nim = berkas.nim')
            ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
            ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
            ->where('berkas.type = 3')->like('berkas.updated_at', $years)->get()->getResultArray();
    }

    public function beasiswaLain($years)
    {
        return $this->table('berkas')->join('user', 'user.nim = berkas.nim')
            ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
            ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
            ->where('berkas.type = 4')->like('berkas.updated_at', $years)->get()->getResultArray();
    }

    // dashboard info
    public function proposal($tahun)
    {
        return $this->table('berkas')->like('updated_at', $tahun)->where(['type' => 1])->where(['approved_Sadmin' => 1]);
    }

    public function laporan($tahun)
    {
        return $this->table('berkas')->like('updated_at', $tahun)->where(['type' => 2])->where(['approved_Sadmin' => 1]);
    }

    public function bawaku($tahun)
    {
        return $this->table('berkas')->like('updated_at', $tahun)->where(['type' => 3])->where(['approved_Sadmin' => 1]);
    }

    public function lain($tahun)
    {
        return $this->table('berkas')->like('updated_at', $tahun)->where(['type' => 4])->where(['approved_Sadmin' => 1]);
    }
}
