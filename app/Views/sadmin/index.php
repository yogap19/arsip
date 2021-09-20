<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <?php
    // query db 
    $db = \Config\Database::connect();
    $beasiswa = $db->table('berkas')->join('user', 'user.nim = berkas.nim')
        ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
        ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
        ->like('berkas.type', 3)->get()->getResultArray();
    $beasiswaLain = $db->table('berkas')->join('user', 'user.nim = berkas.nim')
        ->select('berkas.nim')->select('berkas.updated_at')->select('berkas.id')->select('berkas.title')->select('user.nama')->select('berkas.nik')
        ->select('user.gender')->select('user.rtrw')->select('user.desa')->select('user.kecamatan')->select('user.kota')
        ->like('berkas.type', 4)->get()->getResultArray();

    // card arsip
    $proposal   = $db->table('berkas')->where(['approved_Sadmin' => 1])->where(['type' => 1])->like('updated_at', date('Y'))->get()->getResultArray();
    $laporan    = $db->table('berkas')->where(['approved_Sadmin' => 1])->where(['type' => 2])->like('updated_at', date('Y'))->get()->getResultArray();
    $beasiswa1  = $db->table('berkas')->where(['approved_Sadmin' => 1])->where(['type' => 3])->like('updated_at', date('Y'))->get()->getResultArray();
    $dll        = $db->table('berkas')->where(['approved_Sadmin' => 1])->where(['type' => 4])->like('updated_at', date('Y'))->get()->getResultArray();

    ?>
    <?php
    // ===========================================================Berkas====================================================
    // array berkas
    $p_proposal = 0;
    $p_laporan = 0;
    $p_beasiswa = 0;
    $p_dll = 0;
    $jumlah = count($proposal) + count($beasiswa1) + count($laporan) + count($dll);
    if ($jumlah != null) {
        json_encode($p_proposal = count($proposal) * 100 / $jumlah);
        json_encode($p_laporan = count($laporan) * 100 / $jumlah);
        json_encode($p_beasiswa = count($beasiswa1) * 100 / $jumlah);
        json_encode($p_dll = count($dll) * 100 / $jumlah);
    } else {
        $jumlah = 0;
    }

    // array user
    $Si = [];
    $Ti = [];
    $Ak = [];
    $Mn = [];
    $mi = [];
    $ti = [];
    $ak = [];
    $mn = [];
    foreach ($allUser as $key => $value) {
        if (substr($value['nim'], 0, 2) == 35 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($Si, $value);
        }
        if (substr($value['nim'], 0, 2) == 36 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($Ti, $value);
        }
        if (substr($value['nim'], 0, 2) == 37 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($Ak, $value);
        }
        if (substr($value['nim'], 0, 2) == 38 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($Mn, $value);
        }
        if (substr($value['nim'], 0, 2) == 25 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($mi, $value);
        }
        if (substr($value['nim'], 0, 2) == 26 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($ti, $value);
        }
        if (substr($value['nim'], 0, 2) == 27 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($ak, $value);
        }
        if (substr($value['nim'], 0, 2) == 28 && substr($value['updated_at'], 0, 4) == date('Y') && $value['is_active'] == 1) {
            array_push($mn, $value);
        }
    }
    $p_Si = 0;
    $p_Ti = 0;
    $p_Ak = 0;
    $p_Mn = 0;
    $p_mi = 0;
    $p_ti = 0;
    $p_ak = 0;
    $p_mn = 0;
    $total = count($Si) + count($Ti) + count($Ak) + count($Mn) + count($mi) + count($ti) + count($ak) + count($mn);

    if ($total != null) {
        json_encode($p_Si = count($Si) * 100 / $total);
        json_encode($p_Ti = count($Ti) * 100 / $total);
        json_encode($p_Ak = count($Ak) * 100 / $total);
        json_encode($p_Mn = count($Mn) * 100 / $total);
        json_encode($p_mi = count($mi) * 100 / $total);
        json_encode($p_ti = count($ti) * 100 / $total);
        json_encode($p_ak = count($ak) * 100 / $total);
        json_encode($p_mn = count($mn) * 100 / $total);
    } else {
        $total = 0;
    }

    // ============================================================Chart====================================================
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $a = json_encode($bulan);
    $data = [];
    $januari = [];
    $februari = [];
    $maret = [];
    $april = [];
    $mei = [];
    $juni = [];
    $juli = [];
    $agustus = [];
    $september = [];
    $oktober = [];
    $november = [];
    $desember = [];

    foreach ($allBerkas as $key => $value) {
        if (substr($value['updated_at'], 0, 4) == date('Y') && $value['approved_Sadmin'] == 1) {
            if (substr($value['updated_at'], 5, 2) == '01') {
                array_push($januari, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '02') {
                array_push($februari, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '03') {
                array_push($maret, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '04') {
                array_push($april, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '05') {
                array_push($mei, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '06') {
                array_push($juni, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '07') {
                array_push($juli, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '08') {
                array_push($agustus, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '09') {
                array_push($september, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '10') {
                array_push($oktober, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '11') {
                array_push($november, $value);
            } elseif (substr($value['updated_at'], 5, 2) == '12') {
                array_push($desember, $value);
            }
        }
    }
    array_push($data, count($januari), count($februari), count($maret), count($april), count($mei), count($juni), count($juli), count($agustus), count($september), count($oktober), count($november), count($desember));
    $data = json_encode($data);
    $tahun = [];

    for ($i = intval(date('Y')) - 4; $i <= date('Y'); $i++) {
        array_push($tahun, "Arsip Tahun " . $i);
    }
    $tahun = json_encode($tahun);

    $usrThn = [];
    for ($i = intval(date('Y')) - 4; $i <= date('Y'); $i++) {
        array_push($usrThn, "User Tahun " . $i);
    }
    $usrThn = json_encode($usrThn);

    // arsip tahunan
    $prpTahunan = json_encode($prpTahunan);
    $lprTahunan = json_encode($lprTahunan);
    $bwkTahunan = json_encode($bwkTahunan);
    $bswTahunan = json_encode($bswTahunan);

    // user tahunan
    $siTahunan = json_encode($siTahunan);
    $tiTahunan = json_encode($tiTahunan);
    $akTahunan = json_encode($akTahunan);
    $mnTahunan = json_encode($mnTahunan);
    $mi3Tahunan = json_encode($mi3Tahunan);
    $ti3Tahunan = json_encode($ti3Tahunan);
    $ak3Tahunan = json_encode($ak3Tahunan);
    $mn3Tahunan = json_encode($mn3Tahunan);
    // chart user gender
    $boy = [];
    $girl = [];
    foreach ($allUser as $key => $value) {
        if ($value['gender'] == 1 && substr($value['nim'], 2, 2) == substr(date('Y'), 2, 2) && $value['is_active'] == 1) {
            array_push($boy, $value);
        } elseif ($value['gender'] == 2 && substr($value['nim'], 2, 2) == substr(date('Y'), 2, 2) && $value['is_active'] == 1) {
            array_push($girl, $value);
        }
    }
    ?>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= ($show == 1) ? 'active' : ''; ?>" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-current="true" href="#">Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($show == 2) ? 'active' : ''; ?>" data-toggle="tab" href="#berkas" role="tab" aria-controls="berkas" aria-current="true" href="#">Arsip </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="beasiswa">Beasiswa</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="background: #F2F2F2;">
            <div class="tab-content m-2">
                <!-- Page 1 -->
                <div class="tab-pane <?= ($show == 1) ? 'active' : ''; ?>" id="dashboard" role="tabpanel">
                    <!-- Isi dari Dashboard -->
                    <div>
                        <!-- Card Information -->
                        <div>
                            <div class="text-center mt-3">
                                <h3>Arsip Tahun <?= date('Y'); ?></h3>
                            </div>
                            <div class="row m-2">
                                <!-- card 1  -->
                                <div class="col-3">
                                    <div class="card border-left-primary py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Proposal
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($proposal); ?></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $p_proposal; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="far fa-file-powerpoint fa-2x" style="color: #4E73DF;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card 2  -->
                                <div class="col-3">
                                    <div class="card border-left-success py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laporan
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($laporan); ?></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $p_laporan; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-powerpoint fa-2x" style="color: #1CC88A;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card 3  -->
                                <div class="col-3">
                                    <div class="card border-left-secondary py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Beasiswa Bawaku
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($beasiswa1); ?></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: <?= $p_beasiswa; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-archive fa-2x" style="color: #858796;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card 4  -->
                                <div class="col-3">
                                    <div class="card border-left-info py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Beasiswa Lain
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($dll); ?></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $p_dll; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt fa-2x" style="color: #36B9CC;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- isi -->
                        <div class="row m-1">
                            <!-- chart -->
                            <div class="card col-6">
                                <h3 class="mt-2" style="text-align: center; color: black; font-family: Arial, Helvetica, sans-serif;">Arsip Bulanan Tahun <?= date('Y'); ?></h3>
                                <canvas class="chartjs-render-monitor" id="arsipBulanan"></canvas>
                            </div>
                            <div class="card col-6">
                                <h3 class="mt-2" style="text-align: center; color: black; font-family: Arial, Helvetica, sans-serif;">Type Arsip Tahun <?= date('Y'); ?></h3>
                                <canvas id="arsipType" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-10 m-5">
                                    <h3 class="mt-2" style="text-align: center; color: black; font-family: Arial, Helvetica, sans-serif;">Arsip Tahunan Perguruan Tinggi Indonesia Mandiri</h3>
                                    <canvas id="arsipTahunan"></canvas>
                                </div>
                                <div class="col-1">

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- informasi User -->
                    <div>

                        <br>
                        <div class="card">
                            <div class="row">
                                <div class="col-1">
                                </div>
                                <div class="col-10">
                                    <h3 class="mt-2" style="text-align: center; color: black; font-family: Arial, Helvetica, sans-serif;">Mahasiswa Perguruan Tinggi Indonesia Mandiri</h3>
                                    <canvas id="userLast"></canvas>
                                </div>
                                <div class="col-1">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Page 2 -->
                <div class="tab-pane <?= ($show == 2) ? 'active' : ''; ?>" id="berkas" role="tabpanel">
                    <!-- Isi dari Dashboard -->
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-2">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" style="background: linear-gradient(blue,black);" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="font-weight-bold text-white text-center">Filter by</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" id="collapseCardExample">
                            <div class="card-body">
                                <form action="<?= base_url('SuperAdmin/index'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <!-- type     -->
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="radio" name="type1" id="type_1" value="0" <?= ($type == 0) ? 'checked' : ''; ?>>
                                            <label for="type_1">
                                                All
                                            </label>
                                        </div>
                                        <div class="col-10">
                                            <!-- type -->
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="radio" name="type1" id="type_2" value="1" <?= ($type == 1) ? 'checked' : ''; ?>>
                                                    <label for="type_2">
                                                        Proposal
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type1" id="type_3" value="2" <?= ($type == 2) ? 'checked' : ''; ?>>
                                                    <label for="type_3">
                                                        Laporan
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type1" id="type_4" value="3" <?= ($type == 3) ? 'checked' : ''; ?>>
                                                    <label for="type_4">
                                                        Beasiswa
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type1" id="type_5" value="4" <?= ($type == 4) ? 'checked' : ''; ?>>
                                                    <label for="type_5">
                                                        Doc
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jurusan S1 -->
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="radio" name="type2" id="type1" value="0" <?= ($jurusan == 0) ? 'checked' : ''; ?>>
                                            <label for="type1">
                                                All
                                            </label>
                                        </div>
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type2" value="1" <?= ($jurusan == 1) ? 'checked' : ''; ?>>
                                                    <label for="type2">
                                                        SI (S-1)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type3" value="2" <?= ($jurusan == 2) ? 'checked' : ''; ?>>
                                                    <label for="type3">
                                                        TI (S-1)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type4" value="3" <?= ($jurusan == 3) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="type4">
                                                        AK (S-1)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type5" value="4" <?= ($jurusan == 4) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="type5">
                                                        MN (S-1)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jurusan D3 -->
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type6" value="5" <?= ($jurusan == 5) ? 'checked' : ''; ?>>
                                                    <label for="type6">
                                                        MI (D-3)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type7" value="6" <?= ($jurusan == 6) ? 'checked' : ''; ?>>
                                                    <label for="type7">
                                                        TI (D-3)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type8" value="7" <?= ($jurusan == 7) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="type8">
                                                        AK (D-3)
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type2" id="type9" value="8" <?= ($jurusan == 8) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="type9">
                                                        MN (D-3)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status approved -->
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="radio" name="type3" id="type-1" value="0" <?= ($acepted == 0) ? 'checked' : ''; ?>>
                                            <label for="type-1">
                                                All
                                            </label>
                                        </div>
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="radio" name="type3" id="type-2" value="1" <?= ($acepted == 1) ? 'checked' : ''; ?>>
                                                    <label for="type-2">
                                                        Acepted
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="radio" name="type3" id="type-3" value="3" <?= ($acepted == 3) ? 'checked' : ''; ?>>
                                                    <label for="type-3">
                                                        Rejected
                                                    </label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" name="type3" id="type-4" value="2" <?= ($acepted == 2) ? 'checked' : ''; ?>>
                                                    <label for="type-4">
                                                        Requested
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn text-white " style="background: linear-gradient(blue,black);">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-<?= (session()->getFlashdata('pesan') == 'Hasil tidak ditemukan') ? 'danger' : 'success'; ?> mx-1 my-0 mt-1" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- search -->
                        <div class="row m-1">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <form class="mr-auto ml-md- my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('SuperAdmin/index/1'); ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light " placeholder="Cari dengan kata kunci..." aria-label="Search" autofocus aria-describedby="basic-addon2" name="search" id="search">
                                        <div class="input-group-append">
                                            <button class="btn text-white" style="background: linear-gradient(blue,black);" type="submit" name="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- isi table -->
                        <div class="rounded m-2">
                            <div class="table-responsive rounded">
                                <table class="table-striped table-hover border-dark" width="100%" cellspacing="0">
                                    <tr class="text-dark">
                                        <th class="text-center">NO</th>
                                        <th class="text-center" style="min-width: 150px;">Pengirim</th>
                                        <th class="text-center" style="min-width: 200px;">Nama surat</th>
                                        <th class="text-center" style="min-width: 100px;">Status</th>
                                        <th class="text-center" style="min-width: 100px;">Organisasi</th>
                                        <th class="text-center" style="min-width: 200px;">User</th>
                                        <th class="text-center" style="min-width: 200px;">BEM</th>
                                        <th class="text-center" style="min-width: 200px;">kemahasiswaan</th>
                                        <th class="text-center" style="min-width: 150px;">Updated At</th>
                                    </tr>
                                    <?php ($page == null) ? $page = 1 : $page; ?>
                                    <?php $i = 1 + (5 * ($page - 1)); ?>
                                    <?php ($berkasHasil != null) ? $hasil = $berkasHasil : $hasil = $berkas ?>
                                    <?php foreach ($hasil as $key => $u) : ?>
                                        <?php if ($u['approved_admin'] == 1) : ?>
                                            <tr>
                                                <td class="text-center mx-2"><?= $i; ?></td>
                                                <td class="text-center mx-2"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 10, 30); ?></a></td>
                                                <!-- cek status approved super kemahasiswaan -->
                                                <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                    <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                                <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                    <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                                <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                    <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                                <?php endif; ?>
                                                <td class="text-center"><?= $u['organisasi']; ?></i></td>
                                                <td>
                                                    <textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea>
                                                </td>
                                                <td class="text-center"><?= $u['updated_at']; ?></td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <?php if ($berkasHasil == null) : ?>
                                <?= $pager->links('berkas', 'berkas_pager'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Page 3 -->
                <div class="tab-pane" id="beasiswa" role="tabpane3">
                    <div class="card">
                        <!-- isi -->
                        <div class="accordion" id="accordionExample">
                            <?php for ($years = date('Y'); $years >= 2020; $years--) : ?>
                                <!-- accordion 1 -->
                                <div class="card-header" id="headingOne" style="background: linear-gradient(blue,black);">
                                    <div class="btn btn-link text-white btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne<?= $years; ?>" aria-expanded="true" aria-controls="collapseOne<?= $years; ?>">
                                        Beasiswa Tahun <?= $years; ?>
                                    </div>
                                </div>

                                <div id="collapseOne<?= $years; ?>" class="collapse <?= ($years == date('Y')) ? 'show' : ''; ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <!-- isi -->
                                        <a href="<?= base_url('SuperAdmin/excel/' . $years); ?>">
                                            <div class="row justify-content-end mr-2">
                                                <div class="col-2 text-center btn text-white" style="background: linear-gradient(green,green,black); border-radius: 5px;">
                                                    Convert to Excel <i class="far fa-file-excel"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <!-- table beasiswa -->
                                                <div class="m-1">
                                                    <div class="table-responsive">
                                                        <table class="table-striped table-hover">
                                                            <tr style="height: 40px;">
                                                                <th class="text-center text-white rounded-top" colspan="8" style="background: linear-gradient(grey,black);">
                                                                    Beasiswa BAWAKU
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center">NO</th>
                                                                <th class="text-center" style="min-width: 100px;">NIM</th>
                                                                <th class="text-center" style="min-width: 150px;">Nama Pengirim</th>
                                                                <th class="text-center" style="min-width: 170px;">Jurusan</th>
                                                                <th class="text-center" style="min-width: 150px;">Nama surat</th>
                                                                <th class="text-center" style="min-width: 200px;">NIK</th>
                                                                <th class="text-center" style="min-width: 150px;">Dikirim</th>
                                                            </tr>
                                                            <?php $i = 1; ?>

                                                            <?php foreach ($beasiswa as $key => $u) : ?>
                                                                <?php if (substr($u['updated_at'], 0, 4) == $years) : ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i; ?></td>
                                                                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                                        <td><?= $u['nama']; ?></td>
                                                                        <?php
                                                                        $jurusan = substr($u['nim'], 0, 2);
                                                                        if ($jurusan == 35) {
                                                                            $j = 'Sistem Informasi S-1';
                                                                        } elseif ($jurusan == 36) {
                                                                            $j = 'Teknik Informatika S-1';
                                                                        } elseif ($jurusan == 37) {
                                                                            $j = 'Akuntansi S-1';
                                                                        } elseif ($jurusan == 38) {
                                                                            $j = 'Manajemen S-1';
                                                                        } elseif ($jurusan == 25) {
                                                                            $j = 'Manajemen Informasi D-3';
                                                                        } elseif ($jurusan == 26) {
                                                                            $j = 'Teknik Informatika D-3';
                                                                        } elseif ($jurusan == 27) {
                                                                            $j = 'Akuntansi D-3';
                                                                        } elseif ($jurusan == 28) {
                                                                            $j = 'Manajemen D-3';
                                                                        }
                                                                        ?>
                                                                        <td><?= $j; ?></td>
                                                                        <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 22, 50); ?></a></td>
                                                                        <td><?= $u['nik']; ?></td>
                                                                        <td class="text-center"><?= $u['updated_at']; ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php else : ?>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>
                                                        </table>
                                                        <div class="row ml-3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- table beasiswa lain-->
                                                <div class="m-1">
                                                    <div class="table-responsive">
                                                        <table class="table-striped table-hover ">
                                                            <tr style="height: 40px;">
                                                                <th class="text-center text-white rounded-top" colspan="8" style="background: linear-gradient(grey,black);">
                                                                    Beasiswa Lain
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center">NO</th>
                                                                <th class="text-center" style="min-width: 100px;">NIM</th>
                                                                <th class="text-center" style="min-width: 150px;">Nama Pengirim</th>
                                                                <th class="text-center" style="min-width: 170px;">Jurusan</th>
                                                                <th class="text-center" style="min-width: 150px;">Nama surat</th>
                                                                <th class="text-center" style="min-width: 200px;">NIK</th>
                                                                <!-- <th class="text-center" style="min-width: 300px;">Alamat</th> -->
                                                                <th class="text-center" style="min-width: 150px;">Dikirim</th>
                                                            </tr>
                                                            <?php $i = 1; ?>

                                                            <?php foreach ($beasiswaLain as $key => $u) : ?>
                                                                <?php if (substr($u['updated_at'], 0, 4) == $years) : ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i; ?></td>
                                                                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                                        <td><?= $u['nama']; ?></td>
                                                                        <?php
                                                                        $jurusan = substr($u['nim'], 0, 2);
                                                                        if ($jurusan == 35) {
                                                                            $j = 'Sistem Informasi S-1';
                                                                        } elseif ($jurusan == 36) {
                                                                            $j = 'Teknik Informatika S-1';
                                                                        } elseif ($jurusan == 37) {
                                                                            $j = 'Akuntansi S-1';
                                                                        } elseif ($jurusan == 38) {
                                                                            $j = 'Manajemen S-1';
                                                                        } elseif ($jurusan == 25) {
                                                                            $j = 'Manajemen Informasi D-3';
                                                                        } elseif ($jurusan == 26) {
                                                                            $j = 'Teknik Informatika D-3';
                                                                        } elseif ($jurusan == 27) {
                                                                            $j = 'Akuntansi D-3';
                                                                        } elseif ($jurusan == 28) {
                                                                            $j = 'Manajemen D-3';
                                                                        }
                                                                        ?>
                                                                        <td><?= $j; ?></td>
                                                                        <td style="max-width: 150px;"><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 22, 50); ?></a></td>
                                                                        <td><?= $u['nik']; ?></td>
                                                                        <td class="text-center"><?= $u['updated_at']; ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php else : ?>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>
                                                        </table>
                                                        <div class="row ml-3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // chart bulanan
    var arsBln = document.getElementById("arsipBulanan").getContext('2d');
    var myChart = new Chart(arsBln, {
        type: 'line',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: 'Arsip Bulanan',
                data: <?= $data; ?>,
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Sumber: Data Kemahasiswaan Tahun <?= date('Y'); ?>"
            },
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 5,
                    bottom: 15
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value) + ' doc ';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Document';
                    }
                }
            }
        }
    });


    // chart Tahunan
    var chartOptions = {
        responsive: true,
        legend: {
            position: "bottom",
            labels: {
                usePointStyle: true,
                boxWidth: 6
            }
        },
        title: {
            display: true,
            text: "Statistik Arsip Tahunan"
        },
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value) + ' doc ';
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Doc';
                }
            }
        },
    }
    var barChartData = {
        labels: <?= $tahun ?>,

        datasets: [{
                label: "Proposal",
                backgroundColor: "#4E73DF",
                borderColor: "#4E73DF",
                barThickness: 30,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $prpTahunan; ?>
            },
            {
                label: "Laporan",
                backgroundColor: "#2ACB91",
                borderColor: "#2ACB91",
                barThickness: 30,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $lprTahunan; ?>
            },
            {
                label: "Beasiswa Bawaku",
                backgroundColor: "#858796",
                borderColor: "#858796",
                barThickness: 30,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $bwkTahunan; ?>
            },
            {
                label: "Beasiswa Lain",
                backgroundColor: "#42BDCF",
                borderColor: "#42BDCF",
                barThickness: 30,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $bswTahunan; ?>
            }
        ]
    };
    var ctx = document.getElementById("arsipTahunan").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: chartOptions
    });


    //  chart type
    var optType = {
        responsive: true,
        legend: {
            position: "bottom",
            labels: {
                usePointStyle: true,
                boxWidth: 6
            }
        },
        title: {
            display: true,
            text: "Sumber: Data Kemahasiswaan Tahun <?= date('Y'); ?>"
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        cutoutPercentage: 80,
    }
    var arsipTypedata = {
        labels: [
            'Proposal',
            'Laporan',
            'Beasiswa Bawaku',
            'Beasiswa Lain'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [<?= count($proposal); ?>, <?= count($laporan); ?>, <?= count($beasiswa1); ?>, <?= count($dll); ?>],
            backgroundColor: [
                '#4E73DF',
                '#1CC88A',
                '#858796',
                '#36B9CC'
            ],
            hoverOffset: 1,
            hoverBorderWidth: 3,
            hoverBackgroundColor: ['#4E73DF', '#1CC88A', '#858796', '#36B9CC'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }]
    };
    var arsipType = document.getElementById("arsipType").getContext("2d");
    window.myBar = new Chart(arsipType, {
        type: "doughnut",
        data: arsipTypedata,
        options: optType
    });



    // User Lima Tahun terakhir
    var lastOptions = {
        responsive: true,
        legend: {
            position: "bottom",
            labels: {
                usePointStyle: true,
                boxWidth: 6
            }
        },
        title: {
            display: true,
            text: "Sumber: Data Kemahasiswaan Tahun <?= date('Y'); ?>"
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value) + ' User ';
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' User';
                }
            }
        },
    }
    var barLast = {
        labels: <?= $usrThn ?>,

        datasets: [{
                label: "Sistem Informasi S1",
                backgroundColor: "#4E73DF",
                borderColor: "#4E73DF",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $siTahunan; ?>
            },
            {
                label: "Teknik Informatika S1",
                backgroundColor: "#1CC88A",
                borderColor: "#1CC88A",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $tiTahunan; ?>
            },
            {
                label: "Akuntansi S1",
                backgroundColor: "#E74A3B",
                borderColor: "#E74A3B",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $akTahunan; ?>
            },
            {
                label: "Manajemen S1",
                backgroundColor: "#5A5C69",
                borderColor: "#5A5C69",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $mn3Tahunan; ?>
            },
            {
                label: "Manajemen Informasi D3",
                backgroundColor: "#36B9CC",
                borderColor: "#36B9CC",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $mi3Tahunan; ?>
            },
            {
                label: "Teknik Informatika D3",
                backgroundColor: "#8C8E9C",
                borderColor: "#8C8E9C",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $ti3Tahunan; ?>
            },
            {
                label: "Akuntansi D3",
                backgroundColor: "#F6C23E",
                borderColor: "#F6C23E",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $ak3Tahunan; ?>
            },
            {
                label: "Manajemen D3",
                backgroundColor: "#0000F6",
                borderColor: "#0000F6",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $mn3Tahunan; ?>
            }
        ]
    };
    var ctx = document.getElementById("userLast").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barLast,
        options: lastOptions
    });

    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<!-- detail Modal-->
<?php foreach ($users as $key => $u) : ?>
    <div class="modal fade" id="data<?= $u['nim']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col">
                            <h5 class="modal-title" id="exampleModalLabel"><?= $u['nim']; ?> </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php if ($u['role_id'] == 1) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(blue,black);" id="exampleModalLabel"> Super Administrator</h5>
                            <?php elseif ($u['role_id'] == 2) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(red,black);" id="exampleModalLabel">Administrator</h5>
                            <?php elseif ($u['role_id'] == 3) : ?>
                                <h5 class="badge text-white ml-3" style="background: linear-gradient(grey,black);" id="exampleModalLabel">User</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- isi -->
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img style="width: 300px; height: 300px;" src="<?= base_url(); ?>/img/<?= $u['image']; ?>" alt="<?= $u['image']; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Nama</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['nama']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Jurusan</p>
                                        </div>
                                        <div class="col-8">
                                            <!-- cek jurusan -->
                                            <?php if (substr($u['nim'], 0, 2) == '35') : ?>
                                                <p>Sistem Informasi S-1</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '36') : ?>
                                                <p>Teknik Informatika S-1</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '37') : ?>
                                                <p>Akuntansi S-1</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '38') : ?>
                                                <p>Manajemen S-1</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '25') : ?>
                                                <p>Manajemen Informasi D-3</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '26') : ?>
                                                <p>Teknik Informatika D-3</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '27') : ?>
                                                <p>Akuntansi D-3</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '28') : ?>
                                                <p>Manajemen D-3</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Gender</p>
                                        </div>
                                        <div class="col-8">
                                            <?php if ($u['gender'] == 1) : ?>
                                                <p>Laki - laki</p>
                                            <?php elseif ($u['gender'] == 2) : ?>
                                                <p>Perempuan</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>No telepon</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['telepon']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>E-mail</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['email']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>TTL</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['tmptLahir']; ?>, <?= date("d-m-Y", strtotime($u['tglLahir'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p>Alamat</p>
                                        </div>
                                        <div class="col-8">
                                            <p><?= $u['rtrw']; ?>, <?= $u['desa']; ?>, <?= $u['kecamatan']; ?>, <?= $u['kota']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <p class="card-text"><small class="text-muted">Created at :<?= $u['created_at']; ?></small></p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="card-text"><small class="text-muted">Updated at : <?= $u['updated_at']; ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>