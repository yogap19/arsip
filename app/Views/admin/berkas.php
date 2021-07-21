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
                                                <td class="text-center"><?= $u['nim']; ?></td>
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
                                                <td class="text-center"><?= $u['nim']; ?></td>
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
                                        <td class="text-center"><?= $u['nim']; ?></td>
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
<?= $this->endSection(); ?>