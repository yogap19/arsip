<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="col-md-12 mb-12">
        <div class="nav-tabs-boxed">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <?php $a = count($requested) ?>
                    <a class="nav-link active" data-toggle="tab" href="#requested" role="tab" aria-controls="Profile"><i class="fas fa-list-ol"> Waiting list <?= $a  ?></i></i></a>
                </li>
                <li class="nav-item">
                    <?php $b = count($rejected) ?>
                    <a class="nav-link" data-toggle="tab" href="#rejected" role="tab" aria-controls="profile"><i class="far fa-times-circle" style="color: red;"> Rejected <?= $b; ?></i></a>
                </li>
                <li class="nav-item">
                    <?php $c = count($confirmed) ?>
                    <a class="nav-link" data-toggle="tab" href="#confirmed" role="tab" aria-controls="profile"><i class="fas fa-check" style="color: green;"> Confirmed <?= $c; ?></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- requested -->
                <div class="tab-pane active" id="requested" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="table-responsive">
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
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center" style="min-width: 150px;">Nama surat</th>
                                        <th class="text-center" style="min-width: 50px;">BEM</th>
                                        <th class="text-center" style="min-width: 200px;">User</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($requested as $key => $u) : ?>
                                        <?php if ($u['type'] != 3) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i; ?></td>
                                                <td class="text-center"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                <td><?= substr($u['title'], 10, 50); ?></td>
                                                <!-- cek status approved BEM -->
                                                <?php if ($u['approved_admin'] == '1') : ?>
                                                    <td class="text-center"><i class="far fa-fw fa-check-circle" style="color: green;"></i></td>
                                                <?php elseif ($u['approved_admin'] == '2') : ?>
                                                    <td class="text-center"><i class="fas fa-minus-circle" style="color: grey;"></i></td>
                                                <?php elseif ($u['approved_admin'] == '3') : ?>
                                                    <td class="text-center"><i class="far fa-fw fa-times-circle" style="color: red;"></i></td>
                                                <?php endif; ?>
                                                <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Admin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                                    <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- rejected -->
                <div class="tab-pane" id="rejected" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="card">
                            <div class="table-responsive rounded">
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover">
                                    <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                        <th class="text-center">NO</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center" style="min-width:160px;">Nama surat</th>
                                        <th class="text-center" style="min-width:200px;">User</th>
                                        <th class="text-center" style="min-width:200px;">BEM</th>
                                        <th class="text-center" style="min-width:200px;">Action</th>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rejected as $key => $u) : ?>
                                        <?php if ($u['type'] != 3) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i; ?></td>
                                                <td class="text-center"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                                <td><?= substr($u['title'], 10, 50); ?></td>
                                                <td><textarea class="form-control" readonly><?= $u['keterangan']; ?></textarea></td>
                                                <td><textarea class="form-control" readonly><?= $u['keteranganA']; ?></textarea></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('Admin/approved/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                                                    <a href="<?= base_url('Admin/download/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(blue,black);"><i class="fas fa-download" style="color: white;"></i></a>
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- confirmed -->
                <div class="tab-pane" id="confirmed" role="tabpanel">
                    <div class="card shadow mb-4">
                        <!-- isi -->
                        <div class="table-responsive">
                            <!-- session alert -->
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <table class="table table-hover">
                                <tr class="text-white" style="background: linear-gradient(<?= ($user['role_id'] == 1) ? 'blue' : 'red'; ?>, Black); ">
                                    <th class="text-center">NO</th>
                                    <th class="text-center" style="min-width:100px;">NIM</th>
                                    <th class="text-center" style="min-width:250px;">Nama surat</th>
                                    <th class="text-center" style="min-width:200px;">Kemahasiswaan</th>
                                    <th class="text-center" style="min-width:200px;">Kemahasiswaan</th>
                                    <th class="text-center" style="min-width:200px;">BEM</th>
                                    <th class="text-center" style="min-width:200px;">User</th>
                                    <th class="text-center" style="min-width:130px;">Approved at</th>
                                </tr>
                                <?php $i = 1; ?>
                                <?php foreach ($confirmed as $key => $u) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td class="text-center"><a href="#" data-toggle="modal" data-target="#data<?= $u['nim']; ?>"><?= $u['nim']; ?></a></td>
                                        <td><a href="<?= base_url('Admin/download/' . $u['id']); ?>"><?= substr($u['title'], 10, 50); ?></a></td>
                                        <!-- cek status approved super BEM -->
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
                                        <td><?= $u['updated_at']; ?></td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                            </table>
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