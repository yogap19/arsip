<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\MenuModel;
use \App\Models\BerkasModel;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Stmt\Echo_;

class User extends BaseController
{
    protected $UserModel;
    protected $MenuModel;
    protected $BerkasModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->MenuModel = new MenuModel();
        $this->BerkasModel = new BerkasModel();
        if (!session('nim')) {
            header('Location: ' . base_url('Auth'));
            exit();
        }
    }
    public function index()
    {
        $data = [
            'title' => 'My Profile',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
        ];
        return view('user/index', $data);
    }
    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        return view('user/edit', $data);
    }
    public function editProfile()
    {
        if (!$this->validate([
            'nama'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Nama harus di isi!',
                ]
            ],
            'telepon'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Telepon harus di isi!',
                ]
            ],
            'email'         => [
                'rules'     => 'required|valid_email',
                'errors'    => [
                    'required'      => 'E-mail harus di isi!',
                    'valid_email'   => 'E-mail tidak sesuai!'
                ]
            ],
            'rtrw'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Rt/Rw harus di isi!',
                ]
            ],
            'desa'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Desa harus di isi!',
                ]
            ],
            'kecamatan'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kecamatan harus di isi!',
                ]
            ],
            'kota'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Kota harus di isi!',
                ]
            ],
            'image'         => [
                'rules'     => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors'    => [
                    'max_size'      => 'Ukuran gambar terlalu besar!',
                    'is_image'      => 'Yang anda input bukan gambar!',
                    'mime_in'       => 'Harap masukan gambar dengan benar!',
                ]
            ],
        ])) {

            return redirect()->to('/User/edit')->withInput();
        }
        $oldImage = $this->UserModel->find($this->request->getVar('id'));
        // get image
        $getImage = $this->request->getFile('image');
        // cek field image jika kosong
        if ($getImage->getError() == 4) {
            $upload = $oldImage['image'];
        } else {
            // move image
            $getImage->move('img');
            // get name
            $upload = $getImage->getName();
            // delete old image
            unlink('img/' . $oldImage['image']);
        }
        // simpan ke database
        $this->UserModel->save([
            'id' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'telepon' => $this->request->getVar('telepon'),
            'email' => $this->request->getVar('email'),
            'rtrw' => $this->request->getVar('rtrw'),
            'desa' => $this->request->getVar('desa'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kota' => $this->request->getVar('kota'),
            'image' => $upload
        ]);
        session()->setFlashdata('pesan', 'Profile berhasil dirubah');
        return redirect()->to('/User/edit')->withInput();
    }
    public function upload()
    {
        $data = [
            'title' => 'Upload Berkas',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->where(['nim' => session()->get('nim')])->first(),
            'confirmed' => $this->BerkasModel->where(['nim' => session()->get('nim')])->where(['approved_Sadmin' => 1])->where(['approved_admin' => 1])->find(),
            'requested' => $this->BerkasModel->where(['nim' => session()->get('nim')])->where(['approved_Sadmin' => 2])->where(['approved_admin' => 2])->find(),
            'requestedB' => $this->BerkasModel->where(['nim' => session()->get('nim')])->where(['approved_Sadmin' => 2])->where(['approved_admin' => 1])->find(),
            'rejectedA' => $this->BerkasModel->where(['nim' => session()->get('nim')])->where(['approved_admin' => 3])->find(),
            'rejectedS' => $this->BerkasModel->where(['nim' => session()->get('nim')])->where(['approved_Sadmin' => 3])->find(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        $this->cekSession();
        return view('user/uploadBerkas', $data);
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

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('user/changePassword', $data);
    }

    public function updatePassword()
    {
        $data = $this->UserModel->where(['nim' => session()->get('nim')])->first();
        if (!$this->validate([
            'currentPassword'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Password lama harus terisi!',
                ]
            ],
            'newPassword1'         => [
                'rules'     => 'required|matches[newPassword2]|min_length[6]',
                'errors'    => [
                    'required'      => 'Password baru harus terisi!',
                    'matches'       => 'Password tidak sesuai!',
                    'min_length'    => 'Password minimal 6 karakter!',
                ]
            ],
            'newPassword2'         => [
                'rules'     => 'required|matches[newPassword1]',
                'errors'    => [
                    'required'      => 'Repeat password baru harus terisi!',
                    'matches'       => 'Password tidak sesuai!',
                ]
            ],
        ])) {
            return redirect()->to('/User/changePassword')->withInput();
        }

        $currentPassword = $this->request->getVar('currentPassword');
        $newPassword1 = $this->request->getVar('newPassword1');
        $newPassword2 = $this->request->getVar('ne$newPassword2');

        if (!password_verify($currentPassword, $data['password'])) {
            session()->setFlashdata('pesan', 'Wrong password');
            return redirect()->to('/User/changePassword')->withInput();
        } else {
            if ($currentPassword == $newPassword1) {
                session()->setFlashdata('pesan', 'New password cannot be the same as Current password');
                return redirect()->to('/User/changePassword')->withInput();
            } else {
                // password ok
                $passwordHash = password_hash($newPassword1, PASSWORD_DEFAULT);

                // ubah password
                $this->UserModel->save([
                    'id'        => $data['id'],
                    'password'  => $passwordHash
                ]);
                session()->setFlashdata('success', 'Password changed');
                return redirect()->to('/User/changePassword')->withInput();
            }
        }
    }
    public function doc()
    {
        $data = $this->UserModel->where(['nim' => session()->get('nim')])->first();
        if (!$this->validate([
            'title'         => [
                'rules'     => 'uploaded[title]|max_size[title,30720]|ext_in[title,doc,docx,pdf]',
                'errors'    => [
                    'uploaded'      => 'File belum di pilih!',
                    'max_size'      => 'Ukuran file terlalu besar!',
                    'ext_in'        => 'Type file tidak dizinkan!'
                ]
            ],
        ])) {
            return redirect()->to('/User/upload')->withInput();
        }
        // get type
        $type = $this->request->getVar('type');
        // get file
        $getFile = $this->request->getFile('title');
        // get name
        $name = $getFile->getName();

        if ($type == '1') {
            $upload = 'PRP_' . $name;
        } elseif ($type == '2') {
            $upload = 'LPR_' . $name;
        } elseif ($type == '3') {
            $upload = 'BWK_' . $name;
        } elseif ($type == '4') {
            $upload = 'ALL_' . $name;
        }

        // cek role_id
        if ($data['role_id'] == 2) {
            $accAdmin = 1;
        } else {
            $accAdmin = 2;
        }

        // simpad file
        $getFile->move('doc', $upload);
        // save ke database
        $this->BerkasModel->save([
            'nim' => $data['nim'],
            'title' => $upload,
            'type' => $this->request->getVar('type'),
            'organisasi' => '-',
            'keterangan' => $this->request->getVar('keterangan'),
            'approved_Sadmin' => 2,
            'approved_admin' => $accAdmin,
        ]);
        session()->setFlashdata('success', 'File Berhasil dikirim, harap menunggu konfirmasi Kemahasiswaan dan Administrator');
        return redirect()->to('/User/upload')->withInput();
    }
}

// return $this->response->download('doc/testing.docx', null); download