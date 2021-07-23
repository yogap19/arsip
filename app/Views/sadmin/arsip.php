<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">

    <?php
    $proposal = [];
    $laporan = [];
    $beasiswa = [];
    $dll = [];
    $request = [];
    foreach ($allBerkas as $key => $value) {
        if ($value['approved_admin'] == 1) {
            if ($value['type'] == 1) {
                array_push($proposal, $value);
            } elseif ($value['type'] == 2) {
                array_push($laporan, $value);
            } elseif ($value['type'] == 3) {
                array_push($beasiswa, $value);
            } elseif ($value['type'] == 4) {
                array_push($dll, $value);
            }
            if ($value['approved_Sadmin'] == 2 && $value['approved_admin'] == 1) {
                array_push($request, $value);
            }
        }
    }
    $jumlah = count($proposal) + count($beasiswa) + count($laporan) + count($dll);

    $p_proposal = count($proposal) * 100 / $jumlah;
    $p_laporan = count($laporan) * 100 / $jumlah;
    $p_beasiswa = count($beasiswa) * 100 / $jumlah;
    $p_dll = count($dll) * 100 / $jumlah;
    ?>
    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <!-- Card Information -->
        <div class="row my-3">
            <!-- card 1  -->
            <div class="col-3">
                <div class="card border-left-primary shadow h-100 py-2">
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
                <div class="card border-left-success shadow h-100 py-2">
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
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Beasiswa
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($beasiswa); ?></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width:<?= $p_beasiswa; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-archive fa-2x" style="color: #E85547;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card 4  -->
            <div class="col-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Document
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-bold text-gray-800"><?= count($dll); ?></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width:<?= $p_dll; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <?php $a = count($request) ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($show == 1) ? 'active' : ''; ?>" data-toggle="tab" href="#requested" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a;  ?></i></i></a>
                </li>
                <li class="nav-item">
                    <?php $c = count($rejected) ?>
                    <a class="nav-link <?= ($show == 2) ? 'active' : ''; ?>" data-toggle="tab" href="#rejected" role="tab" aria-controls="profile"><i class="far fa-times-circle" style="color: red;"> Rejected <?= $c; ?></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($show == 3) ? 'active' : ''; ?>" data-toggle="tab" href="#confirmed" role="tab" aria-controls="profile"><i class="fas fa-check" style="color: green;"> Confirmed <?= count($confirmed); ?></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- requested -->
                <div class="tab-pane <?= ($show == 1) ? 'active' : ''; ?>" id="requested" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- search -->
                        <div class="row">
                            <div class="col-1">
                            </div>
                            <div class="col-5"></div>
                            <div class="col-5 my-2 ml-5">
                                <form class="mr-auto ml-md- my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('SuperAdmin/arsip'); ?>" method="POST">
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
                        <div class="card mx-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('danger')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('danger'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-striped table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center" style="min-width: 200px;">Nama surat</th>
                                        <th class="text-center" style="min-width: 150px;">Status</th>
                                        <th class="text-center" style="min-width: 200px;">BEM</th>
                                        <th class="text-center" style="min-width: 200px;">Keterangan User</th>
                                        <th class="text-center" style="min-width: 150px;">Tanggal Kirim</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
                                    </tr>
                                    <?php $i = 1 + (5 * ($page - 1)); ?>
                                    <?php foreach ($requested as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                            <td><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 10, 50); ?></a></td>
                                            <!-- cek status approved kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td class="text-center"><?= $u['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                                <?= $pagers1->links('arsip', 'berkas_pager'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- rejected -->
                <div class="tab-pane <?= ($show == 2) ? 'active' : ''; ?>" id="rejected" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card m-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center" style="min-width: 200px;">Nama surat</th>
                                        <th class="text-center" style="min-width: 150px;">kemahasiswaan</th>
                                        <th class="text-center" style="min-width: 200px;">BEM</th>
                                        <th class="text-center" style="min-width: 200px;">Keterangan User</th>
                                        <th class="text-center" style="min-width: 150px;">Rejected At</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rejected as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                            <td><a href="<?= base_url('SuperAdmin/download/' . $u['id']); ?>"><?= substr($u['title'], 10, 50); ?></a></td>
                                            <!-- cek status approved kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                            <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                            <td class="text-center"><?= $u['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" style="background: linear-gradient(red,black);" class="btn-circle" data-toggle="modal" data-target="#delete">
                                                    <i class="fas fa-fw fa-trash text-white"></i>
                                                </a>
                                                <!-- Delete Modal-->
                                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Anda yakin ingin menghapus berkas dengan nama <?= $u['title']; ?>.</div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <form action="<?= base_url(); ?>/User/delete/<?= $u['id']; ?>" method="post" class="d-inline">
                                                                    <?= csrf_field(); ?>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- confirmed -->
                <div class="tab-pane <?= ($show == 3) ? 'active' : ''; ?>" id="confirmed" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card m-3">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center" style="min-width: 200px;">Nama surat</th>
                                        <th class="text-center" style="min-width: 150px;">Status</th>
                                        <th class="text-center" style="min-width: 200px;">Kemahasiswaan</th>
                                        <th class="text-center" style="min-width: 200px;">BEM</th>
                                        <th class="text-center" style="min-width: 200px;">Keterangan User</th>
                                        <th class="text-center" style="min-width: 150px;">Confirmed At</th>
                                        <th class="text-center">Option</th>
                                        <th class="text-center">Download</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($confirmed as $key => $u) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                            <td><a href="<?= base_url('Admin/download/' . $u['id']); ?>"><?= substr($u['title'], 10, 50); ?></a></td>
                                            <!-- cek status approved super kemahasiswaan -->
                                            <?php if ($u['approved_Sadmin'] == '1') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '2') : ?>
                                                <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                            <?php elseif ($u['approved_Sadmin'] == '3') : ?>
                                                <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                            <?php endif; ?>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keteranganS']; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea>
                                            </td>
                                            <td class="text-center"><?= $u['updated_at']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('SuperAdmin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end table navigasi -->
    </div>



</div>


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
                                                <p>Sistem Informasi</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '36') : ?>
                                                <p>Teknik Informatika</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '37') : ?>
                                                <p>Akuntansi</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '38') : ?>
                                                <p>Manajemen</p>
                                            <?php elseif (substr($u['nim'], 0, 2) == '25') : ?>
                                                <p>Manajemen Informasi</p>
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