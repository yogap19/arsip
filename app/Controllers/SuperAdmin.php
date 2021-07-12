<?php

namespace App\Controllers;


use \App\Models\UserModel;
use \App\Models\MenuModel;
use \App\Models\BerkasModel;
use CodeIgniter\HTTP\Request;
use PhpParser\Node\Stmt\Echo_;

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require 'vendor/autoload.php';


class SuperAdmin extends BaseController
{
    protected $UserModel;
    protected $MenuModel;
    protected $BerkasModel;
    protected $spreadsheet;
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
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
        $search     = $this->request->getVar('search');
        $type       = $this->request->getVar('type1');
        $jurusan    = $this->request->getVar('type2');
        $acepted    = $this->request->getVar('type3');

        //  Filter By
        if ($type == 0 && $jurusan == 0 && $acepted == 0) {
            $hasil = null;
            unset($_SESSION['pesan']);
        } elseif ($type == 0 && $jurusan == 0) {
            $hasil = $this->BerkasModel->where(['approved_Sadmin' => $acepted])->find();
            $show = 2;
        } elseif ($type == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->find();
            $show = 2;
        } elseif ($jurusan == 0 && $acepted == 0) {
            $hasil = $this->BerkasModel->where(['type' => $type])->find();
            $show = 2;
        } elseif ($jurusan == 0) {
            $hasil = $this->BerkasModel->where(['type' => $type])->where(['approved_Sadmin' => $acepted])->find();
            $show = 2;
        } elseif ($acepted == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->where(['type' => $type])->find();
            $show = 2;
        } elseif ($type == 0) {
            $hasil = $this->BerkasModel->where(['jurusan' => $jurusan])->where(['approved_Sadmin' => $acepted])->find();
            $show = 2;
        } else {
            $hasil = $this->BerkasModel->where(['type' => $type])->where(['jurusan' => $jurusan])->where(['approved_Sadmin' => $acepted])->find();
            $show = 2;
        }

        // cek pesan
        if ($type == 0 && $jurusan == 0 && $acepted == 0) {
        } else {
            if ($hasil == null) {
                session()->setFlashdata('pesan', 'Hasil tidak ditemukan');
            } elseif ($hasil) {
                # code...
                session()->setFlashdata('pesan', 'Hasil filter ' . count($hasil));
            }
        }

        // chart Arsip Tahunan
        $prpTahunan = [];
        $lprTahunan = [];
        $bwkTahunan = [];
        $bswTahunan = [];
        for ($tahun = intval(date('Y')) - 4; $tahun <= date('Y'); $tahun++) {
            # code...
            $proposal = count($this->BerkasModel->proposal($tahun)->find());
            array_push($prpTahunan, $proposal);

            $laporan = count($this->BerkasModel->laporan($tahun)->find());
            array_push($lprTahunan, $laporan);

            $bawaku = count($this->BerkasModel->bawaku($tahun)->find());
            array_push($bwkTahunan, $bawaku);

            $lain = count($this->BerkasModel->lain($tahun)->find());
            array_push($bswTahunan, $lain);
        }

        // Chart User Tahunan
        $siTahunan = [];
        $tiTahunan = [];
        $akTahunan = [];
        $mnTahunan = [];
        $mi3Tahunan = [];
        $ti3Tahunan = [];
        $ak3Tahunan = [];
        $mn3Tahunan = [];
        for ($tahun = substr(intval(date('Y')), 2, 2) - 4; $tahun <= substr(date('Y'), 2, 2); $tahun++) {
            $Si = count($this->UserModel->Si($tahun)->find());
            array_push($siTahunan, $Si);
            $Ti = count($this->UserModel->Ti($tahun)->find());
            array_push($tiTahunan, $Ti);
            $Ak = count($this->UserModel->Ak($tahun)->find());
            array_push($akTahunan, $Ak);
            $Mn = count($this->UserModel->Mn($tahun)->find());
            array_push($mnTahunan, $Mn);
            $mi3 = count($this->UserModel->mi3($tahun)->find());
            array_push($mi3Tahunan, $mi3);
            $ti3 = count($this->UserModel->ti3($tahun)->find());
            array_push($ti3Tahunan, $ti3);
            $ak3 = count($this->UserModel->ak3($tahun)->find());
            array_push($ak3Tahunan, $ak3);
            $mn3 = count($this->UserModel->mn3($tahun)->find());
            array_push($mn3Tahunan, $mn3);
        }

        // pencarian berkas
        if ($search != null) {
            $hasil = $this->BerkasModel->berkas($search)->get()->getResultArray();
            $show = 2;
            $berkas = $this->BerkasModel;
            session()->set($show);
        } else {
            $berkas = $this->BerkasModel;
            $show = 1;
            session()->set($show);
        }
        $pages = $this->request->getVar('page_berkas');
        if ($pages == null && $search == null && $hasil == null) {
            $show = 1;
        } else {
            $show = 2;
        }
        $data = [
            // page required
            'title'         => 'Dashboard',
            'user'          => $this->UserModel->where(['nim' => session()->get('nim')])->first(),

            // data required
            'users'         => $this->UserModel->findAll(),
            'allBerkas'     => $this->BerkasModel->findAll(),
            'allUser'       => $this->UserModel->findAll(),

            // style data 
            'berkas'        => $berkas->where(['approved_admin' => 1])->orderBy('updated_at', 'DESC')->paginate(5, 'berkas'),
            'pager'         => $this->BerkasModel->pager,
            'berkasHasil'   => $hasil,

            // required chart arsip tahunan
            'prpTahunan'    => $prpTahunan,
            'lprTahunan'    => $lprTahunan,
            'bwkTahunan'    => $bwkTahunan,
            'bswTahunan'    => $bswTahunan,

            // required chart user tahunan
            'siTahunan'     => $siTahunan,
            'tiTahunan'     => $tiTahunan,
            'akTahunan'     => $akTahunan,
            'mnTahunan'     => $mnTahunan,
            'mi3Tahunan'    => $mi3Tahunan,
            'ti3Tahunan'    => $ti3Tahunan,
            'ak3Tahunan'    => $ak3Tahunan,
            'mn3Tahunan'    => $mn3Tahunan,

            // Filter required
            'type'          => $type,
            'jurusan'       => $jurusan,
            'acepted'       => $acepted,
            'page'          => $pages,

            'show'          => $show
        ];
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
        $pages = $this->request->getVar('page_akun') ? $this->request->getVar('page_akun') : 1;
        $akun = $this->UserModel;
        $hasil = null;
        $search = $this->request->getVar('search');
        if ($search) {
            $hasil = $akun->like('nim', $search)->orLike('nama', $search)->get()->getResultArray();
        } else {
            $akun = $this->UserModel;
        }
        $data = [
            'title'     => 'Role Account',
            'user'      => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'akun'      => $akun->orderBy('role_id', 'ASC')->paginate(5, 'akun'),
            'search'    => $hasil,
            'pager'     => $this->UserModel->pager,
            'page'      => $pages
        ];
        // d($data);
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
        $search = $this->request->getVar('search');
        if ($search) {
            $berkas = $this->BerkasModel->berkas($search);
        } else {
            $berkas = $this->BerkasModel;
            # code...
        }
        $pages = $this->request->getVar('page_arsip') ? $this->request->getVar('page_arsip') : 1;
        $show = 1;
        $data = [
            'title'         => 'Arsip',
            'user'          => $this->UserModel->where(['nim' => session()->get('nim')])->first(),
            'users'         => $this->UserModel->findAll(),
            'allBerkas'     => $this->BerkasModel->find(),
            'requested'     => $berkas->where(['approved_sadmin' => 2])->like('updated_at', date('Y'))->orderBy('updated_at', 'DESC')->paginate(5, 'arsip'),
            'pagers1'       => $this->BerkasModel->pager,
            'rejected'      => $this->BerkasModel->where(['approved_Sadmin' => 3])->find(),
            'confirmed'     => $this->BerkasModel->where(['approved_Sadmin' => 1])->find(),
            'validation'    => \Config\Services::validation(),
            'page'          => $pages,
            'show'          => $show,
        ];
        // d($data);
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
            $type = 'S$Si';
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

    public function excel($years)
    {

        $spreadsheet = new Spreadsheet();
        // bawaku
        $spreadsheet->getActiveSheet()->getStyle('A1:S2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A1')
            ->getFill()->getStartColor()->setARGB('FFFF0000');
        $sheet = $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'Beasiswa Bawaku');
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'NIM');
        $sheet->setCellValue('C2', 'NAMA');
        $sheet->setCellValue('D2', 'JURUSAN');
        $sheet->setCellValue('E2', 'Gender');
        $sheet->setCellValue('F2', 'Surat');
        $sheet->setCellValue('G2', 'NIK');
        $sheet->setCellValue('H2', 'Alamat');
        $sheet->setCellValue('I2', 'Tanggal Terima');

        // beasiswa lain
        // $spreadsheet->getActiveSheet()->getStyle('K1')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('K1')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('K1')
            ->getFill()->getStartColor()->setARGB('FFFF0000');
        $sheet = $spreadsheet->getActiveSheet()->mergeCells('K1:S1');
        $sheet->setCellValue('K1', 'Beasiswa Lain');
        $sheet->setCellValue('K2', 'No');
        $sheet->setCellValue('L2', 'NIM');
        $sheet->setCellValue('M2', 'NAMA');
        $sheet->setCellValue('N2', 'JURUSAN');
        $sheet->setCellValue('O2', 'Gender');
        $sheet->setCellValue('P2', 'Surat');
        $sheet->setCellValue('Q2', 'NIK');
        $sheet->setCellValue('R2', 'Alamat');
        $sheet->setCellValue('S2', 'Tanggal Terima');

        $berkas = $this->BerkasModel->beasiswa($years);
        $beasiswaLain = $this->BerkasModel->beasiswaLain($years);
        $no = 1;
        $x = 3;
        foreach ($berkas as $row) {
            if ($row['gender'] == 1) {
                $gender = 'Laki-laki';
            } else {
                $gender = 'Perempuan';
            }

            if (substr($row['nim'], 0, 2) == 35) {
                $jurusan = 'Sistem Informasi S-1';
            } elseif (substr($row['nim'], 0, 2) == 36) {
                $jurusan = 'Teknik Informatika S-1';
            } elseif (substr($row['nim'], 0, 2) == 36) {
                $jurusan = 'Teknik Informatika S-1';
            } elseif (substr($row['nim'], 0, 2) == 37) {
                $jurusan = 'Akuntansi S-1';
            } elseif (substr($row['nim'], 0, 2) == 38) {
                $jurusan = 'Manajemen S-1';
            } elseif (substr($row['nim'], 0, 2) == 25) {
                $jurusan = 'Manajemen Informasi D-3';
            } elseif (substr($row['nim'], 0, 2) == 26) {
                $jurusan = 'Teknik Informatika D-3';
            } elseif (substr($row['nim'], 0, 2) == 27) {
                $jurusan = 'Akuntansi D-3';
            } elseif (substr($row['nim'], 0, 2) == 28) {
                $jurusan = 'Manajemen D-3';
            }
            // bawaku
            $alamat = $row['rtrw'] . ', ' . $row['desa'] . ', ' . $row['kecamatan'] . ', ' . $row['kota'];
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row['nim']);
            $sheet->setCellValue('C' . $x, $row['nama']);
            $sheet->setCellValue('D' . $x, $jurusan);
            $sheet->setCellValue('E' . $x, $gender);
            $sheet->setCellValue('F' . $x, $row['title']);
            $sheet->setCellValue('G' . $x, $row['nik']);
            $sheet->setCellValue('H' . $x, $alamat);
            $sheet->setCellValue('I' . $x, $row['updated_at']);
            $x++;
        }
        $no = 1;
        $x = 3;
        foreach ($beasiswaLain as $row) {
            if ($row['gender'] == 1) {
                $gender = 'Laki-laki';
            } else {
                $gender = 'Perempuan';
            }

            if (substr($row['nim'], 0, 2) == 35) {
                $jurusan = 'Sistem Informasi S-1';
            } elseif (substr($row['nim'], 0, 2) == 36) {
                $jurusan = 'Teknik Informatika S-1';
            } elseif (substr($row['nim'], 0, 2) == 36) {
                $jurusan = 'Teknik Informatika S-1';
            } elseif (substr($row['nim'], 0, 2) == 37) {
                $jurusan = 'Akuntansi S-1';
            } elseif (substr($row['nim'], 0, 2) == 38) {
                $jurusan = 'Manajemen S-1';
            } elseif (substr($row['nim'], 0, 2) == 25) {
                $jurusan = 'Manajemen Informasi D-3';
            } elseif (substr($row['nim'], 0, 2) == 26) {
                $jurusan = 'Teknik Informatika D-3';
            } elseif (substr($row['nim'], 0, 2) == 27) {
                $jurusan = 'Akuntansi D-3';
            } elseif (substr($row['nim'], 0, 2) == 28) {
                $jurusan = 'Manajemen D-3';
            }
            // lain
            $alamat = $row['rtrw'] . ', ' . $row['desa'] . ', ' . $row['kecamatan'] . ', ' . $row['kota'];
            $sheet->setCellValue('K' . $x, $no++);
            $sheet->setCellValue('L' . $x, $row['nim']);
            $sheet->setCellValue('M' . $x, $row['nama']);
            $sheet->setCellValue('N' . $x, $jurusan);
            $sheet->setCellValue('O' . $x, $gender);
            $sheet->setCellValue('P' . $x, $row['title']);
            $sheet->setCellValue('Q' . $x, $row['nik']);
            $sheet->setCellValue('R' . $x, $alamat);
            $sheet->setCellValue('S' . $x, $row['updated_at']);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Beasiswa Tahun ' . $years;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // return redirect()->to(base_url('SuperAdmin'));
    }
    public function download($id)
    {
        $berkas = $this->BerkasModel->find($id);
        $data = 'Here is some text!';
        return $this->response->download($berkas['title'], $data);
        return redirect()->to('SuperAdmin')->withInput();
    }
}
