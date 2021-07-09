<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\MenuModel;
use \App\Models\BerkasModel;
use PhpParser\Node\Stmt\Echo_;

class Admin extends BaseController
{
    protected $UserModel;
    protected $MenuModel;
    protected $BerkasModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->MenuModel = new MenuModel();
        $this->BerkasModel = new BerkasModel();
        $this->cekSession();
    }
    public function index($id = '')
    {
        $id =  intval($id);
        $search = $this->request->getVar('search');
        if ($search) {
            $users = $this->UserModel->akun($search);
        } else {
            $users = $this->UserModel;
            # code...
        }
        // $users = $this->UserModel;
        $pages = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $data = [
            'title'     => 'Management Account',
            'users'     => $users->orderBy('created_at', 'ASC')->paginate(5, 'users'),
            'pager'     => $this->UserModel->pager,
            'allUsers'  => $this->UserModel->findAll(),
            'user'      => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'confirmed' => $this->UserModel->where(['is_active' => '1'])->find(),
            'requested' => $this->UserModel->where(['is_active' => '0'])->find(),
            'page'      => $pages,
            'tahun'     => $id
        ];
        // dd($data);
        return view('admin/index', $data);
    }
    public function activationRole($id)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'menu' => $this->UserModel->where(['id' => $id])->first()
        ];
        return view('admin/activation', $data);
    }
    public function updateActivation($id)
    {
        $t = $this->request->getVar('is_active');
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
            'is_active' => $t,
        ]);
        session()->setFlashdata('pesan', 'Perubahan berhasil dilakukan');
        return redirect()->to(base_url('Admin'));
    }

    private  function cekSession($segment = '')
    {
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
            } else {
                $menu = "Administrator Menu";
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
    public function berkas()
    {
        $this->cekSession2();
        $data = [
            'title' => 'Berkas',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'requested' => $this->BerkasModel->where(['approved_admin' => 2])->find(),
            'confirmed' => $this->BerkasModel->where(['approved_admin' => 1])->find(),
            'rejected' => $this->BerkasModel->where(['approved_admin' => 3])->find(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        $this->cekSession2();
        return view('admin/berkas', $data);
    }
    private  function cekSession2($segment = '')
    {
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
            if ($a == 1) {
                header('Location: ' . base_url('Auth/blocked'));
                exit();
            }
        }
    }
    public function deleteRole($id)
    {
        $this->UserModel->delete(['id' => $id]);
        session()->setFlashdata('pesan', 'User berhasil dihapus');
        return redirect()->to(base_url('Admin'));
    }
    public function download($id)
    {
        $berkas = $this->BerkasModel->find($id);
        $data = 'Here is some text!';
        return $this->response->download($berkas['title'], $data);
        return redirect()->to('/Admin/berkas')->withInput();
    }
    public function approved($id)
    {
        $this->cekSession2();
        $data = [
            'title' => 'Berkas',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/approved', $data);
    }
    public function approve($id)
    {
        $data = $this->BerkasModel->find($id);
        if (!$this->validate([
            'keterangan'     => [
                'rules'        => 'required',
                'errors'    => ['required'      => 'Keterangan harus di isi!']
            ],
        ])) {
            return redirect()->to('/Admin/approved/' . $data['id'])->withInput();
        }
        // // type
        if ($data['type'] == 1) {
            $type = 'Proposal';
        } elseif ($data['type'] == 2) {
            $type = 'Laporan';
        } elseif ($data['type'] == 3) {
            $type = 'Formulir beasiswa';
        } elseif ($data['type'] == 4) {
            $type = 'Document';
        }
        // ambil status approved
        $approved = $this->request->getVar('approved_admin');
        if ($approved == null) {
            $approved = 3;
        }
        // ambil keterangan
        $keterangan = $this->request->getVar('keterangan');

        // save database
        $this->BerkasModel->save([
            'id'        => $id,
            'approved_admin' => $approved,
            'keteranganA' => $keterangan,
        ]);

        // jikia confirmed dan rejected
        if ($approved == 1) {
            session()->setFlashdata('success', $type . ' dengan nama ' . $data['title'] .  ' Confirmed');
        } else {
            session()->setFlashdata('danger', $type . ' dengan nama ' . $data['title'] .  ' Rejected');
        }

        return redirect()->to(base_url('Admin/berkas'));
    }
    public function delete($id)
    {
        $data = $this->BerkasModel->find($id);
        $this->BerkasModel->delete(['id' => $id]);
        unlink('doc/' . $data['title']);
        session()->setFlashdata('danger', 'Berkas dengan nama ' . $data['title'] . ' berhasil dihapus');
        return redirect()->to(base_url('Admin/berkas'));
    }
    // public function back($id)
    // {
    //     $id = $id;
    //     $data = [
    //         'title'     => 'Management Account',
    //         'user'      => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
    //         'back'      => $id,
    //         'pager'     => $this->UserModel->pager,
    //         'allUsers'   => $this->UserModel->findAll(),
    //         'user'      => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
    //         'confirmed' => $this->UserModel->where(['is_active' => '1'])->find(),
    //         'requested' => $this->UserModel->where(['is_active' => '0'])->find(),
    //     ];
    //     return view('admin/index', $data);
    // }
}
