<?php

namespace App\Controllers;

use \App\Models\UserModel;
use \App\Models\MenuModel;
use \App\Models\BerkasModel;
use \App\Models\BroadcastModel;
use CodeIgniter\Validation\Rules;
use PhpParser\Node\Stmt\Echo_;

class User extends BaseController
{
    protected $UserModel;
    protected $MenuModel;
    protected $BerkasModel;
    protected $BroadcastModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->MenuModel = new MenuModel();
        $this->BerkasModel = new BerkasModel();
        $this->BroadcastModel = new BroadcastModel();
        if (!session('nim')) {
            header('Location: ' . base_url('Auth'));
            exit();
        }
    }
    public function index()
    {
        $broadcast = $this->BroadcastModel->findAll();
        $data = [
            'title'     => 'My Profile',
            'user'      => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'broadcast' => $broadcast
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
        // cek field image jika image tidak di upload
        if ($getImage->getError() == 4) {
            $upload = $oldImage['image'];
        } else {
            // get name
            $upload = $getImage->getName();

            // beri penamaan
            $upload = $oldImage['nim'] . '_' . $upload;
            // move image
            $getImage->move('img', $upload);
            // delete old image
            if ($upload != 'default.svg' && $oldImage["image"] != 'default.svg') {
                unlink('img/' . $oldImage["image"]);
            }
        }
        // simpan ke database
        $this->UserModel->save([
            'id' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'telepon' => $this->request->getVar('telepon'),
            'email' => $this->request->getVar('email'),
            'rtrw' => substr($this->request->getVar('rtrw'), 0, 4),
            'desa' => $this->request->getVar('desa'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kota' => $this->request->getVar('kota'),
            'image' => $upload
        ]);
        session()->setFlashdata('pesan', 'Profile berhasil dirubah');
        return redirect()->to('/User/edit')->withInput();
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
        return view('user/upload', $data);
    }
    public function doc()
    {
        $data = $this->UserModel->where(['nim' => session()->get('nim')])->first();
        $berkas = $this->BerkasModel->where(['nim' => session()->get('nim')])->find();
        $cekType = $this->request->getVar('type');
        if ($cekType == 1 || $cekType == 2) {
            if (!$this->validate([
                'title'         => [
                    'rules'     => 'uploaded[title]|max_size[title,30720]|ext_in[title,doc,docx,pdf]',
                    'errors'    => [
                        'uploaded'      => 'File belum di pilih!',
                        'max_size'      => 'Ukuran file terlalu besar!',
                        'ext_in'        => 'Type file tidak dizinkan!'
                    ]
                ],
                'organisasi'         => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pilih organisasi telebih dahulu!',
                    ]
                ],
            ])) {
                $show = ['show' => 1];
                session()->set($show);
                return redirect()->to('/User/upload')->withInput();
            }
        } elseif ($cekType == 3 || $cekType == 4) {
            if (!$this->validate([
                'title'         => [
                    'rules'     => 'uploaded[title]|max_size[title,30720]|ext_in[title,doc,docx,pdf]',
                    'errors'    => [
                        'uploaded'      => 'File belum di pilih!',
                        'max_size'      => 'Ukuran file terlalu besar!',
                        'ext_in'        => 'Type file tidak dizinkan!'
                    ]
                ],
                'nik'           => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'NIK belum diisi!',
                    ]
                ],
                'semester'           => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Semester belum diisi!',
                    ]
                ],
                'orangTua'           => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Nama Orang Tua / Wali belum diisi!',
                    ]
                ],

                'pekerjaan'           => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Pekerjaan Orang Tua / Wali belum diisi!',
                    ]
                ],
            ])) {
                $show = ['show' => 2];
                session()->set($show);
                return redirect()->to('/User/upload')->withInput();
            }
        }

        // get data
        $type = $this->request->getVar('type');
        $organisasi = $this->request->getVar('organisasi');
        // get file
        $getFile = $this->request->getFile('title');
        // get name
        $name = $getFile->getName();

        // cek role_id
        if ($data['role_id'] == 2) {
            $accAdmin = 1;
        } else {
            $accAdmin = 2;
        }

        // beri nama file
        if ($type == '1') {
            $upload = $data['nim'] . '_PRP_' . $organisasi .  '_' . date('m-Y') .  '_' . $name;
        } elseif ($type == '2') {
            $upload = $data['nim'] . '_LPR_' . $organisasi . '_' . date('m-Y') . '_' . $name;
        } elseif ($type == '3') {
            $upload = $data['nim'] . '_BWK_' . date('m-Y') . '_' . $name;
            $accAdmin = 1;
        } elseif ($type == '4') {
            $upload = $data['nim'] . '_BSW_' . date('m-Y') . '_' . $name;
            $accAdmin = 1;
        }

        // keterangan
        if ($data['role_id'] == 2) {
            $keteranganA =  $this->request->getVar('keterangan');
            $keterangan = '';
        } elseif ($data['role_id'] == 3) {
            $keteranganA =  '';
            $keterangan = $this->request->getVar('keterangan');
        }

        // isi jurusan
        if (substr($data['nim'], 0, 2) == '35') {
            $jurusan = 1;
        } elseif (substr($data['nim'], 0, 2) == '36') {
            $jurusan = 2;
        } elseif (substr($data['nim'], 0, 2) == '37') {
            $jurusan = 3;
        } elseif (substr($data['nim'], 0, 2) == '38') {
            $jurusan = 4;
        } elseif (substr($data['nim'], 0, 2) == '25') {
            $jurusan = 5;
        } elseif (substr($data['nim'], 0, 2) == '26') {
            $jurusan = 6;
        } elseif (substr($data['nim'], 0, 2) == '27') {
            $jurusan = 7;
        } elseif (substr($data['nim'], 0, 2) == '28') {
            $jurusan = 8;
        }

        if ($type == 1 || $type == 2) {
            $organisasi = $this->request->getVar('organisasi');
            $nik = '-';
            $semester = '-';
            $orangTua = '-';
            $pekerjaan = '-';
        } elseif ($type == 3 || $type == 4) {
            $organisasi = '-';
            $nik = $this->request->getVar('nik');
            $semester = $this->request->getVar('semester');
            $orangTua = $this->request->getVar('orangTua');
            $pekerjaan = $this->request->getVar('pekerjaan');
        }
        // cek isi berkas
        if ($berkas == null) {
            // simpad file
            $getFile->move('doc', $upload);
            // save ke database
            $this->BerkasModel->save([
                'nim'               => $data['nim'],
                'title'             => $upload,
                'type'              => $this->request->getVar('type'),
                'jurusan'           => $jurusan,
                'keteranganA'       => $keteranganA,
                'keterangan'        => $keterangan,
                'approved_Sadmin'   => 2,
                'approved_admin'    => $accAdmin,
                'organisasi'        => $organisasi,
                'nik'               => $nik,
                'semester'          => $semester,
                'orangTua'          => $orangTua,
                'pekerjaan'         => $pekerjaan,
            ]);
            session()->setFlashdata('success', 'File dengan nama ' . $upload . ' Berhasil dikirim, harap menunggu konfirmasi Kemahasiswaan dan Administrator');
            return redirect()->to('/User/upload')->withInput();
        } else {
            $t = false;
            // cek apakah ada file pernah dikirim sebelumnya
            foreach ($berkas as $key => $value) {
                if ($value['title'] == $upload) {
                    $t = true;
                } else {
                    if ($t == true) {
                        $t = true;
                    } else {
                        $t = false;
                    }
                }
            }
            if ($t === true) {
                session()->setFlashdata('danger', 'File dengan nama ' . $upload . ' pernah dikirim sebelumnya');
                return redirect()->to('/User/upload')->withInput();
            } else {
                // simpad file
                $getFile->move('doc', $upload);
                // save ke database
                $this->BerkasModel->save([
                    'nim' => $data['nim'],
                    'title' => $upload,
                    'type' => $this->request->getVar('type'),
                    'jurusan' => $jurusan,
                    'keteranganA' => $keteranganA,
                    'keterangan' => $keterangan,
                    'approved_Sadmin' => 2,
                    'approved_admin' => $accAdmin,
                    'organisasi'        => $organisasi,
                    'nik'               => $nik,
                    'semester'          => $semester,
                    'orangTua'          => $orangTua,
                    'pekerjaan'         => $pekerjaan,
                ]);
                session()->setFlashdata('success', 'File dengan nama ' . $upload . ' Berhasil dikirim, harap menunggu konfirmasi Kemahasiswaan dan Administrator');
                return redirect()->to('/User/upload')->withInput();
            }
        }
    }

    public function revisi($id)
    {
        $data = [
            'title' => 'Form revisi',
            'user' => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'berkas' => $this->BerkasModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('User/revisi', $data);
    }
    public function revisiUpload($id)
    {
        $berkas = $this->BerkasModel->find($id);
        if ($berkas['type'] == 3 || $berkas['type'] == 4) {
            if (!$this->validate([
                'title'         => [
                    'rules'     => 'uploaded[title]|max_size[title,30720]|ext_in[title,doc,docx,pdf]',
                    'errors'    => [
                        'uploaded'      => 'File belum di pilih!',
                        'max_size'      => 'Ukuran file terlalu besar!',
                        'ext_in'        => 'Type file tidak dizinkan!'
                    ]
                ],
                'nik'         => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'NIK belum di isi!',
                    ]
                ],
                'keterangan'         => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Keterangan pembaruan belum di isi!',
                    ]
                ],
            ])) {
                return redirect()->to('/User/revisi/' . $id)->withInput();
            }
        } else {
            if (!$this->validate([
                'title'         => [
                    'rules'     => 'uploaded[title]|max_size[title,30720]|ext_in[title,doc,docx,pdf]',
                    'errors'    => [
                        'uploaded'      => 'File belum di pilih!',
                        'max_size'      => 'Ukuran file terlalu besar!',
                        'ext_in'        => 'Type file tidak dizinkan!'
                    ]
                ],
                'keterangan'         => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required'      => 'Keterangan pembaruan belum di isi!',
                    ]
                ],
            ])) {
                return redirect()->to('/User/revisi/' . $id)->withInput();
            }
        }

        $berkas = $this->BerkasModel->find($id);
        $user = $this->UserModel->where(['nim' => session()->get('nim')])->first();
        // // get file
        $getFile = $this->request->getFile('title');
        // get name
        $name = $getFile->getName();

        // cek user role id
        if ($user['role_id'] == 2) {
            $approvedA = 1;
        } else {
            $approvedA = 2;
        }

        // beri nama type
        if ($berkas['type'] == '1') {
            $upload = $berkas['nim'] . '_PRP_' . $berkas['organisasi'] . '_' . date('m-Y') . '_' . $name;
        } elseif ($berkas['type'] == '2') {
            $upload = $berkas['nim'] . '_LPR_' . $berkas['organisasi'] . '_' . date('m-Y') . '_' . $name;
        } elseif ($berkas['type'] == '3') {
            $upload = $berkas['nim'] . '_BWK_' . date('m-Y') . '_' . $name;
            $approvedA = 1;
        } elseif ($berkas['type'] == '4') {
            $upload = $berkas['nim'] . '_BSW_' . date('m-Y') . '_' . $name;
            $approvedA = 1;
        }

        // hapus file lama
        unlink('doc/' . $berkas['title']);

        // simpad file
        $getFile->move('doc', $upload);


        // keterangan
        if ($user['role_id'] == 2) {
            $keterangan =  $this->request->getVar('keterangan');
        } elseif ($user['role_id'] == 3) {
            $keterangan =  '';
        }

        // update database
        $this->BerkasModel->save([
            'id'                => $id,
            'title'             => $upload,
            'nik'               => $this->request->getVar('nik'),
            'approved_Sadmin'   => 2,
            'approved_admin'    => $approvedA,
            'keteranganA'       => $keterangan,
            'keterangan'        => $this->request->getVar('keterangan'),
        ]);
        session()->setFlashdata('success', 'File dengan nama ' . $upload . ' Berhasil direvisi, harap menunggu konfirmasi ulang');
        return redirect()->to('/User/upload')->withInput();
    }

    public function download($id)
    {
        $berkas = $this->BerkasModel->find($id);
        $data = 'Here is some text!';
        return $this->response->download($berkas['title'], $data);
        return redirect()->to('/User/upload')->withInput();
    }

    public function delete($id)
    {
        $data = $this->BerkasModel->find($id);
        $this->BerkasModel->delete(['id' => $id]);
        unlink('doc/' . $data['title']);
        session()->setFlashdata('danger', 'Berkas dengan nama ' . $data['title'] . ' berhasil dihapus');
        return redirect()->to(base_url('User/upload'));
    }
}

// return $this->response->download('doc/testing.docx', null); download