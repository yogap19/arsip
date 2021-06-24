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
        return $this->table('berkas')->like('nim', $search)
            ->orLike('title', $search)->orLike('updated_at', $search)
            ->orLike('keterangan', $search)->orLike('keteranganA', $search)
            ->orLike('keteranganS', $search);
    }
}
