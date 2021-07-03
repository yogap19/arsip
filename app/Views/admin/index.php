<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">



</div>
<?php $allUser = count($users); ?>
<?php $confirm = count($confirmed); ?>
<?php $request = count($requested); ?>

<!-- table navigasi -->
<div class="col-md-12 mb-12">
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

<?= $this->endSection(); ?>