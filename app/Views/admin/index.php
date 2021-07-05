<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">



</div>
<?php $allUser = count($allUsers); ?>
<?php $confirm = count($confirmed); ?>
<?php $request = count($requested); ?>

<!-- table navigasi -->
<div class="col-md-12 mb-12">
    <!-- chart -->
    <div class="card mb-3">
        <div class="row">
            <div class="col-12">
                <div class="col">
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <div id="user" style="min-width: 310px; height: 270px; max-width:100%; margin: 0 auto"></div>
                </div>
            </div>
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

                                <!-- search -->
                                <div class="row mb-1">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <form class="mr-auto ml-md- my-md-0 mw-100 navbar-search" action="<?= base_url('Admin/index'); ?>" method="POST">
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
$tahun = [];
for ($i = intval(date('Y')) - 4; $i <= date('Y'); $i++) {
    # code...
    array_push($tahun, $i);
}
$tahun = json_encode($tahun);

// Jumlah Akun SI S-1
$Si = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '35' . $thn)->get()->getResultArray();
    array_push($Si, count($SiUser));
}
$Si = json_encode($Si);

// Jumlah Akun TI S-1
$Ti = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '36' . $thn)->get()->getResultArray();
    array_push($Ti, count($SiUser));
}
$Ti = json_encode($Ti);

// Jumlah Akun Ak S-1
$Ak = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '37' . $thn)->get()->getResultArray();
    array_push($Ak, count($SiUser));
}
$Ak = json_encode($Ak);

// Jumlah Akun TI S-1
$Mn = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '38' . $thn)->get()->getResultArray();
    array_push($Mn, count($SiUser));
}
$Mn = json_encode($Mn);

// Jumlah Akun TI S-1
$mi = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '25' . $thn)->get()->getResultArray();
    array_push($mi, count($SiUser));
}
$mi = json_encode($mi);

// Jumlah Akun TI S-1
$ti = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '26' . $thn)->get()->getResultArray();
    array_push($ti, count($SiUser));
}
$ti = json_encode($ti);

// Jumlah Akun TI S-1
$ak = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '27' . $thn)->get()->getResultArray();
    array_push($ak, count($SiUser));
}
$ak = json_encode($ak);

// Jumlah Akun TI S-1
$mp = [];
for ($thn = intval(substr(date('Y'), 2, 2)) - 4; $thn <= substr(date('Y'), 2, 2); $thn++) {
    # code...
    $SiUser = $db->table('user')->like('nim', '28' . $thn)->get()->getResultArray();
    array_push($mp, count($SiUser));
}
$mp = json_encode($mp);

?>

<script type='text/javascript'>
    Highcharts.chart('user', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data User 5 Tahun Terakhir'
        },
        subtitle: {
            text: 'Sumber : Data Kemahasiswaan'
        },
        xAxis: {
            categories: <?= $tahun; ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah User'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Document</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Sistem Informasi (S-1)',
            data: <?= $Si; ?>

        }, {
            name: 'Teknik Informatika (S-1)',
            data: <?= $Ti; ?>


        }, {
            name: 'Akuntansi (S-1)',
            data: <?= $Ak; ?>


        }, {
            name: 'Manajemen (S-1)',
            data: <?= $Mn; ?>
        }, {
            name: 'Manajemen Informasi (D-3)',
            data: <?= $mi; ?>


        }, {
            name: 'Teknik Informatika (D-3)',
            data: <?= $ti; ?>


        }, {
            name: 'Akuntansi (D-3)',
            data: <?= $ak; ?>
        }, {
            name: 'Manajemen (D-3)',
            data: <?= $mp; ?>
        }]
    });
</script>
<?= $this->endSection(); ?>