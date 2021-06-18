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

        // mencari bruth force coy
        // type
        if ($type == 0 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->findAll();
        } elseif ($type == 1 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->find();
        } elseif ($type == 2 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->find();
        } elseif ($type == 3 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->find();
        } elseif ($type == 4 && $jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->find();
            //jurusan
        } elseif ($type == 0 && $jurusan == 1 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => '1'])->find();
        } elseif ($type == 0 && $jurusan == 2 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => '2'])->find();
        } elseif ($type == 0 && $jurusan == 3 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => '3'])->find();
        } elseif ($type == 0 && $jurusan == 4 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => '4'])->find();
            //accepted
        } elseif ($type == 0 && $jurusan == 0 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 0 && $jurusan == 0 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['approved_Sadmin' => '2'])->find();
            // type dan jurusan 1 accepted 0
        } elseif ($type == 1 && $jurusan == 1 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->find();
        } elseif ($type == 2 && $jurusan == 1 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->find();
        } elseif ($type == 3 && $jurusan == 1 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->find();
        } elseif ($type == 4 && $jurusan == 1 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->find();
            // type dan jurusan 2 accepted 0
        } elseif ($type == 1 && $jurusan == 2 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->find();
        } elseif ($type == 2 && $jurusan == 2 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '2'])->find();
        } elseif ($type == 3 && $jurusan == 2 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '2'])->find();
        } elseif ($type == 4 && $jurusan == 2 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '2'])->find();
            // type dan jurusan 3 accepted 0
        } elseif ($type == 1 && $jurusan == 3 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->find();
        } elseif ($type == 2 && $jurusan == 3 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '3'])->find();
        } elseif ($type == 3 && $jurusan == 3 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '3'])->find();
        } elseif ($type == 4 && $jurusan == 3 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '3'])->find();
            // type dan jurusan 4 accepted 0
        } elseif ($type == 1 && $jurusan == 4 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->find();
        } elseif ($type == 2 && $jurusan == 4 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '4'])->find();
        } elseif ($type == 3 && $jurusan == 4 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '4'])->find();
        } elseif ($type == 4 && $jurusan == 4 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '4'])->find();
            // 1 type dan jurusan 1 accepted 1
        } elseif ($type == 1 && $jurusan == 1 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 1 && $jurusan == 1 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
            // type 2 dan jurusan 1 accepted 1
        } elseif ($type == 2 && $jurusan == 1 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 2 && $jurusan == 1 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '2'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
        } elseif ($type == 3 && $jurusan == 1 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 3 && $jurusan == 1 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '3'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
        } elseif ($type == 4 && $jurusan == 1 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 4 && $jurusan == 1 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '4'])->where(['jurusan' => '1'])->where(['approved_Sadmin' => '2'])->find();
            //    e2a
        } elseif ($type == 1 && $jurusan == 2 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 1 && $jurusan == 2 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '2'])->where(['approved_Sadmin' => '2'])->find();
            //    e3a
        } elseif ($type == 1 && $jurusan == 3 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 1 && $jurusan == 3 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '3'])->where(['approved_Sadmin' => '2'])->find();
            //    e4a
        } elseif ($type == 1 && $jurusan == 4 && $acepted == 1) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '1'])->find();
        } elseif ($type == 1 && $jurusan == 4 && $acepted == 2) {
            $hasil = $this->BerkasModel->where(['type' => '1'])->where(['jurusan' => '4'])->where(['approved_Sadmin' => '2'])->find();
        }
        $data = [
            'title' => 'Dashboard',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->findAll(),
            'berkasHasil' => $hasil,
            'berkasNim' => $this->BerkasModel->where(['nim' => $search])->find(),
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
        // ambil keterangan
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
}
