<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">



</div>
<?php $allUser = count($allUsers); ?>
<?php $confirm = count($confirmed); ?>
<?php $request = count($requested); ?>
<?php $btn = (session()->get('role_id') == 1) ? 'blue' : 'red' ?>
<?php ($tahun == 0) ? $tahun = 1 : $tahun = $tahun + 1; ?>

<!-- table navigasi -->
<div class="col-md-12 mb-12">
    <!-- chart -->
    <div class="card mb-3">
        <div class="row align-items-center justify-content-center">
            <form action="<?= base_url('admin/index/' . $tahun); ?>" method="POST">
                <button type="submit" style="background: white; border: 0;">
                    <div class="col-1">
                        <i class="fas fa-step-backward" style="color: <?= $btn; ?>;"></i>
                    </div>
                </button>
            </form>
            <div class="col-10">
                <div class="col">
                    <canvas id="userLast" height="70px"></canvas>
                </div>
            </div>
            <form action="<?= base_url('admin/index/' . ($tahun - 2)); ?>" method="POST">
                <button type="submit" style="background: white; border: 0;">
                    <div class="col-1">
                        <i class="fas fa-step-forward" style="color: <?= $btn; ?>;"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>

    <div class="nav-tabs-boxed">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#index" role="tab" aria-controls="Profile"><i class="fas fa-users">All users <?= $allUser; ?></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#service" role="tab" aria-controls="Profile"><i class="fas fa-user-check">Confirmed <?= $confirm; ?></i></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"><i class="fas fa-user-plus">Requested <?= $request; ?></i></a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- service 1 -->
            <div class="tab-pane active" id="index" role="tabpanel" active>
                <!-- header -->
                <div class="card shadow mb-4">
                    <!-- isi -->
                    <div class="table-responsive">
                        <!-- Table Users -->
                        <div class="card">
                            <!-- session alert -->
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('danger')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('danger'); ?>
                                </div>
                            <?php endif; ?>

                            <!-- search -->
                            <div class="row ">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <form class="mr-auto ml-md- my-md-0 mw-100 navbar-search" action="<?= base_url('Admin/index'); ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light " placeholder="Cari dengan kata kunci..." aria-label="Search" autofocus aria-describedby="basic-addon2" name="search" id="search">
                                            <div class="input-group-append">
                                                <button class="btn text-white" style="background: linear-gradient(<?= $btn; ?>,black);" type="submit" name="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th class="text-center">Gender</th>
                                    <th>No Telepon</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <?php $i = 1 + (5 * ($page - 1)); ?>
                                <?php foreach ($users as $key => $u) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td class="text-center"><?= $u['nim']; ?></td>
                                        <td><?= $u['nama']; ?></td>
                                        <td class="text-center"><i class="<?= ($u['gender'] == 1) ? 'fas fa-mars' : 'fas fa-venus'; ?>" style="color: <?= ($u['gender'] == 1) ? 'blue' : 'rgb(251,57,101)'; ?>;"></i></td>
                                        <td><?= $u['telepon']; ?></td>
                                        <td><?= $u['email']; ?></td>
                                        <td class="text-center">
                                            <i class="<?= ($u['is_active']) ? 'far fa-fw fa-check-circle' : 'far fa-fw fa-times-circle'; ?>" style="color: <?= ($u['is_active']) ? 'green' : 'red'; ?>;"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('Admin/activationRole/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                            </table>
                            <div class="row ml-3">
                                <?= $pager->links('users', 'berkas_pager'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end service 1 -->
            </div>
            <!-- service2 -->
            <div class="tab-pane" id="service" role="tabpanel">
                <div class="card shadow mb-4">
                    <!-- isi -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Table Users -->
                            <div class="card">
                                <!-- session alert -->
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('danger')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('danger'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th class="text-center">Gender</th>
                                        <th>No Telepon</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($confirmed as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td class="text-center"><?= $u['nim']; ?></td>
                                            <td><?= $u['nama']; ?></td>
                                            <td class="text-center"><i class="<?= ($u['gender'] == 1) ? 'fas fa-mars' : 'fas fa-venus'; ?>" style="color: <?= ($u['gender'] == 1) ? 'blue' : 'rgb(251,57,101)'; ?>;"></i></td>
                                            <td><?= $u['telepon']; ?></td>
                                            <td><?= $u['email']; ?></td>
                                            <td class="text-center">
                                                <i class="<?= ($u['is_active']) ? 'far fa-fw fa-check-circle' : 'far fa-fw fa-times-circle'; ?>" style="color: <?= ($u['is_active']) ? 'green' : 'red'; ?>;"></i>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/activationRole/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service3 -->
            <div class="tab-pane" id="profile" role="tabpanel">
                <div class="card shadow mb-4">
                    <!-- isi -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Table Users -->
                            <div class="card">
                                <!-- session alert -->
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('danger')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('danger'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th class="text-center">Gender</th>
                                        <th>No Telepon</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($requested as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td class="text-center"><?= $u['nim']; ?></td>
                                            <td><?= $u['nama']; ?></td>
                                            <td class="text-center"><i class="<?= ($u['gender'] == 1) ? 'fas fa-mars' : 'fas fa-venus'; ?>" style="color: <?= ($u['gender'] == 1) ? 'blue' : 'rgb(251,57,101)'; ?>;"></i></td>
                                            <td><?= $u['telepon']; ?></td>
                                            <td><?= $u['email']; ?></td>
                                            <td class="text-center">
                                                <i class="<?= ($u['is_active']) ? 'far fa-fw fa-check-circle' : 'far fa-fw fa-times-circle'; ?>" style="color: <?= ($u['is_active']) ? 'green' : 'red'; ?>;"></i>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/activationRole/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end table navigasi -->
</div>

<?php
$db = \Config\Database::connect();
$usrThn = [];
for ($i = (intval(date('Y')) - (4 * $tahun)); $i <= (intval(date('Y')) - (4 * ($tahun - 1))); $i++) {
    # code...
    array_push($usrThn, $i);
}
$usrThn = json_encode($usrThn);

// Jumlah Akun SI S-1
$Si = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '35' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($Si, count($SiUser));
}
$Si = json_encode($Si);

// Jumlah Akun TI S-1
$Ti = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '36' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($Ti, count($SiUser));
}
$Ti = json_encode($Ti);

// Jumlah Akun Ak S-1
$Ak = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '37' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($Ak, count($SiUser));
}
$Ak = json_encode($Ak);

// Jumlah Akun TI S-1
$Mn = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '38' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($Mn, count($SiUser));
}
$Mn = json_encode($Mn);

// Jumlah Akun TI S-1
$mi = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '25' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($mi, count($SiUser));
}
$mi = json_encode($mi);

// Jumlah Akun TI S-1
$ti = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '26' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($ti, count($SiUser));
}
$ti = json_encode($ti);

// Jumlah Akun TI S-1
$ak = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '27' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($ak, count($SiUser));
}
$ak = json_encode($ak);

// Jumlah Akun TI S-1
$mp = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - (4 * $tahun); $thn <= substr(date('Y'), 2, 2) - (4 * ($tahun - 1)); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '28' . $thn)->where(['is_active' => 1])->get()->getResultArray();
    array_push($mp, count($SiUser));
}
$mp = json_encode($mp);

?>

<script type='text/javascript'>
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
            text: "Statistik User 5 Tahun Terakhir"
        },
        scales: {
            yAxes: [{
                // display: false,
                ticks: {
                    callback: function(label, index, labels) {
                        for (let d = 0.5; d < 1000; d++) {
                            if (label == d) {
                                label = '';
                            }
                        }
                        return label;
                    }
                },
                gridLines: {
                    drawBorder: false,
                },
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                },
            }],
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
                data: <?= $Si; ?>
            },
            {
                label: "Teknik Informatika S1",
                backgroundColor: "#1CC88A",
                borderColor: "#1CC88A",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $Ti; ?>
            },
            {
                label: "Akuntansi S1",
                backgroundColor: "#E74A3B",
                borderColor: "#E74A3B",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $Ak; ?>
            },
            {
                label: "Manajemen S1",
                backgroundColor: "#5A5C69",
                borderColor: "#5A5C69",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $Mn; ?>
            },
            {
                label: "Manajemen Informasi D3",
                backgroundColor: "#36B9CC",
                borderColor: "#36B9CC",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $mi; ?>
            },
            {
                label: "Teknik Informatika D3",
                backgroundColor: "#8C8E9C",
                borderColor: "#8C8E9C",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $ti; ?>
            },
            {
                label: "Akuntansi D3",
                backgroundColor: "#F6C23E",
                borderColor: "#F6C23E",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $ak; ?>
            },
            {
                label: "Manajemen D3",
                backgroundColor: "#0000F6",
                borderColor: "#0000F6",
                barThickness: 20,
                maxBarThickness: 50,
                borderWidth: 1,
                data: <?= $mp; ?>
            }
        ]

    };
    var ctx = document.getElementById("userLast").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barLast,
        options: lastOptions
    });
</script>
<?= $this->endSection(); ?>