<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

    protected $table = 'user_sub_menu';
    protected $allowedFields = ['title', 'is_active'];

    public function getMenu($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
