<?php
$role_id = session()->get('role_id');
$nim = session()->get('nim');
$i = 1;

if ($role_id == 1) {
    $color = 'blue';
    $heksa = '0,0,255';
} elseif ($role_id == 2) {
    $color = 'red';
    $heksa = '255,0,0';
} else {
    $color = 'black';
    $heksa = '0,0,0';
}


// code jurusan
if (substr($nim, 0, 2) == 35) {
    $codeJurusan = 0;
} elseif (substr($nim, 0, 2) == 36) {
    $codeJurusan = 1;
} elseif (substr($nim, 0, 2) == 37) {
    $codeJurusan = 2;
} elseif (substr($nim, 0, 2) == 38) {
    $codeJurusan = 3;
} elseif (substr($nim, 0, 2) == 25) {
    $codeJurusan = 4;
} elseif (substr($nim, 0, 2) == 26) {
    $codeJurusan = 5;
} elseif (substr($nim, 0, 2) == 27) {
    $codeJurusan = 6;
} elseif (substr($nim, 0, 2) == 28) {
    $codeJurusan = 7;
}
$tahun = substr(date('Y'), 2, 2);
if ($tahun - substr($nim, 2, 2)  == 5) {
    $codeSemester = 13;
} elseif ($tahun - substr($nim, 2, 2)  == 4) {
    $codeSemester = 12;
} elseif ($tahun - substr($nim, 2, 2)  == 3) {
    $codeSemester = 11;
} elseif ($tahun - substr($nim, 2, 2)  == 2) {
    $codeSemester = 10;
} elseif ($tahun - substr($nim, 2, 2)  == 1) {
    $codeSemester = 9;
}
?>
<?php $db = \Config\Database::connect(); ?>
<?php
// db query
$broadcast = $db->table('user')
    ->join('broadcast', 'user.nim = broadcast.pengirim')
    ->select('user.image')->select('broadcast.pengirim')->select('broadcast.subject')->select('broadcast.pesan')->select('broadcast.created_at')
    ->select('user.nim')->select('broadcast.count')->select('broadcast.code')->select('broadcast.id')->get()->getResultArray();
// d($broadcast);
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" style="background: linear-gradient(<?= $color; ?>,black);">
                    Broadcast Message
                </h6>
                <?php foreach ($broadcast as $key => $b) : ?>
                    <?php if ($b['count'] > time()) : ?>
                        <?php if (substr($b['code'], $codeJurusan, 1) == 1 && substr($b['code'], $codeSemester, 1) == 1) : ?>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal" data-target="#data<?= $b['id']; ?>">
                                <div class="mr-3">
                                    <div>
                                        <img src="<?= base_url(); ?>/img/<?= $b['image']; ?>" class="img-profile rounded-circle" width="50px" height="50px" alt="Image" srcset="">
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><strong style="color: black;"><?= $b['subject']; ?></strong> (<?= $b['created_at']; ?>)</div>
                                    <span class="font-weight-bold"><?= substr($b['pesan'], 0, 22); ?> <span class="text-gray-500"> . . .</span> </span>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Clear All Broadcast</a>
            </div>
        </li>

        <!-- detail Modal-->
        <?php foreach ($broadcast as $key => $u) : ?>
            <div class="modal fade" id="data<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= base_url('/img/' . $u['image']); ?>" class="img-thumbnail" alt="Image" width="50px" height="50px">
                                    <h5 class="modal-title badge " id="exampleModalLabel"><?= $u['nim']; ?> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5 class="badge ml-3 text-gray-500" id="exampleModalLabel"><?= $u['created_at']; ?></h5>
                                </div>
                            </div>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- isi -->
                            <div class="card mb-3">
                                <div class="row m-1">
                                    <div class="col">
                                        <h5 class="text-center"><Strong><?= $u['subject']; ?></Strong></h5>
                                        <hr>
                                        <p><?= $u['pesan']; ?></p>
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

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                <?php if ($user['image'] == 'default.svg') : ?>
                    <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/<?= ($user['gender'] == '1') ? 'boy.svg' : 'girl.svg'; ?>">
                <?php else : ?>
                    <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/<?= $user['image']; ?>">
                <?php endif; ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('User'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->