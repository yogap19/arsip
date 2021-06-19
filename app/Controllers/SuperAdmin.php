<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\MenuModel;
use \App\Models\BerkasModel;
use PhpParser\Node\Stmt\Echo_;

class SuperAdmin extends BaseController
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
        if (!session('nim')) {
            header('Location: ' . base_url('Auth'));
            exit();
        }
    }
    public function index()
    {
        $search = $this->request->getVar('search');
        $type = $this->request->getVar('type1');
        $jurusan = $this->request->getVar('type2');
        $acepted = $this->request->getVar('type3');

        if ($type == 0) {
            $type = '0';
        } elseif ($jurusan == 0) {
            $jurusan = '0';
        } elseif ($acepted == 0) {
            $acepted = '0';
        }
        // brute force itu tidak indah
        if ($type == 0 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->findAll();
        } elseif ($type == 0 && $jurusan == 0) {
            $hasil = $this->BerkasModel->where(['approved_Sadmin' => $acepted])->find();
        } elseif ($type == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->find();
        } elseif ($jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => $type])->find();
        } elseif ($jurusan == 0) {
            $hasil = $this->BerkasModel->where(['type' => $type])->where(['approved_Sadmin' => $acepted])->find();
        } elseif ($acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->where(['type' => $type])->find();
        } elseif ($type == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->where(['approved_Sadmin' => $acepted])->find();
        } else {
            $hasil = $this->BerkasModel->where(['type' => $type])->where(['jurusan' => $jurusan])->where(['approved_Sadmin' => $acepted])->find();
        }
        //  end brute force
        $data = [
            'title' => 'Dashboard',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->findAll(),
            'berkasHasil' => $hasil,
            'berkasNim' => $this->BerkasModel->where(['nim' => $search])->find(),
            'type' => $type,
            'jurusan' => $jurusan,
            'acepted' => $acepted,
        ];
        // dd($data);
        return view('sadmin/index', $data);
    }
    public function search()
    {
        // ambil data dari form 
        $search = $this->request->getVar('search');

        // cari data dari database
        $berkas = $this->BerkasModel->where(['nim' => $search])->find();

        return view('sadmin/index', $berkas);
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
        return view('sadmin/activation', $data);
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
    public function arsip()
    {
        $data = [
            'title' => 'Arsip',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'requested' => $this->BerkasModel->where(['approved_Sadmin' => 2])->where(['approved_admin' => 1])->find(),
            'confirmed' => $this->BerkasModel->where(['approved_Sadmin' => 1])->find(),
            'rejected' => $this->BerkasModel->where(['approved_Sadmin' => 3])->find(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        return view('sadmin/arsip', $data);
    }
    public function approved($id)
    {
        $data = [
            'title' => 'Berkas',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('Sadmin/approved', $data);
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
            return redirect()->to('/SuperAdmin/approved/' . $data['id'])->withInput();
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
        $approved = $this->request->getVar('approved_Sadmin');
        if ($approved == null) {
            $approved = 3;
        }
        $keterangan = $this->request->getVar('keterangan');

        // save database
        $this->BerkasModel->save([
            'id'        => $id,
            'approved_Sadmin' => $approved,
            'keteranganS' => $keterangan,
        ]);

        // jikia confirmed dan rejected
        if ($approved == 1) {
            session()->setFlashdata('success', $type . ' dengan nama ' . $data['title'] .  ' Confirmed');
        } else {
            session()->setFlashdata('danger', $type . ' dengan nama ' . $data['title'] .  ' Rejected');
        }

        return redirect()->to(base_url('SuperAdmin/arsip'));
    }

    public function delete($id)
    {
        $data = $this->BerkasModel->find($id);
        $this->BerkasModel->delete(['id' => $id]);
        unlink('doc/' . $data['title']);
        session()->setFlashdata('danger', 'Berkas dengan nama ' . $data['title'] . ' berhasil dihapus');
        return redirect()->to(base_url('SuperAdmin/arsip'));
    }
}
