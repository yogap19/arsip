<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\MenuModel;
use PhpParser\Node\Stmt\Echo_;

class SuperAdmin extends BaseController
{
    protected $UserModel;
    protected $MenuModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->MenuModel = new MenuModel();
        $this->cekSession();
        if (!session('nim')) {
            header('Location: ' . base_url('Auth'));
            exit();
        }
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
        ];

        return view('sadmin/index', $data);
    }
    public function manageMenu()
    {
        $data = [
            'title' => 'Management Menu',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'menu' => $this->MenuModel->findAll(),
        ];
        return view('sadmin/manageMenu', $data);
    }
    private  function cekSession($segment = '')
    {
        $data = [
            'title' => 'Dashboard',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
        ];
        $request = \Config\Services::request();
        $db = \Config\Database::connect();
        if (session('nim') == null) {
            header('Location: ' . base_url('Auth'));
            exit();
        } else {
            $role_id = session()->get('role_id');
            // $segments = $this->request->getSegments();

            $menu = $request->uri->getSegment(1);
            if ($menu == 'SuperAdmin') {
                $menu = "Super Administrator Menu";
            } elseif ($menu == 'Admin') {
                $menu = "Administrator Menu";
            } elseif ($menu == 'User') {
                $menu = "Users";
            }
            $query = $db->table('user_menu')->getWhere(['menu' => $menu])
                ->getResultArray();
            foreach ($query as $key => $menu_id) {
            }
            $a = intval($role_id);
            $b = intval($menu_id['id']);
            if ($a > $b) {
                header('Location: ' . base_url('Auth/blocked'));
                exit();
            }
        }
    }
    public function roleAkun()
    {
        $data = [
            'title' => 'Role Account',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'users' => $this->UserModel->findAll(),
        ];
        // dd($data);
        return view('sadmin/roleAkun', $data);
    }
    public function activation($id)
    {
        $data = [
            'title' => 'Edit',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'menu' => $this->MenuModel->where(['id' => $id])->first()
        ];
        return view('sadmin/edit', $data);
    }
    public function update($id)
    {
        $t = $this->request->getVar('is_active');
        if ($t == null) {
            $t = 0;
        }
        // dd($id);
        $this->MenuModel->save([
            'id'        => $id,
            'is_active' => $t,
        ]);
        session()->setFlashdata('pesan', 'Perubahan berhasil dilakukan');
        return redirect()->to(base_url('SuperAdmin/manageMenu'));
    }
    public function activationRole($id)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'menu' => $this->UserModel->where(['id' => $id])->first()
        ];
        return view('sadmin/editRole', $data);
    }
    public function updateRole($id)
    {
        $t = $this->request->getVar('role_id');
        if ($t == '1') {
            $t = 1;
        } elseif ($t == '2') {
            $t = 2;
        } elseif ($t == '3') {
            $t = 3;
        }
        // dd($t);
        $this->UserModel->save([
            'id'        => $id,
            'role_id' => $t,
        ]);
        session()->setFlashdata('pesan', 'Perubahan berhasil dilakukan');
        return redirect()->to(base_url('SuperAdmin/roleAkun'));
    }

    public function deleteRole($id)
    {
        $this->UserModel->delete(['id' => $id]);
        session()->setFlashdata('pesan', 'User berhasil dihapus');
        return redirect()->to(base_url('SuperAdmin/roleAkun'));
    }
}
