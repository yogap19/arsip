<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <!-- session alert -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <!-- search -->
        <div class="row">
            <div class="col-6 m-2">
                <form class="mr-auto ml-md- my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('SuperAdmin/roleAkun'); ?>" method="POST">
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
            <div class="col-6">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <tr class="text-white" style="background: linear-gradient(Blue, Black); ">
                <th>NO</th>
                <th>NIM</th>
                <th>Nama</th>
                <th class="text-center">Gender</th>
                <th>No Telepon</th>
                <th>Role Akun</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $i = 1 + (5 * ($page - 1)); ?>
            <?php if ($search) : ?>
                <?php $akun = $search ?>
            <?php endif; ?>
            <?php foreach ($akun as $key => $u) : ?>
                <tr>
                    <td class="text-center"><?= $i; ?></td>
                    <td class="text-center"><?= $u['nim']; ?></td>
                    <td><?= $u['nama']; ?></td>
                    <td class="text-center"><i class="<?= ($u['gender'] == 1) ? 'fas fa-mars' : 'fas fa-venus'; ?>" style="color: <?= ($u['gender'] == 1) ? 'blue' : 'rgb(251,57,101)'; ?>;"></i></td>
                    <td><?= $u['telepon']; ?></td>
                    <!-- cek role akun -->
                    <?php if ($u['role_id'] == 1) : ?>
                        <td><span class="badge text-white" style="background: linear-gradient(blue,black);">Super Administrator</span></td>
                    <?php elseif ($u['role_id'] == 2) : ?>
                        <td><span class="badge text-white" style="background: linear-gradient(red,black);">Administrator</span></td>
                    <?php elseif ($u['role_id'] == 3) : ?>
                        <td><span class="badge text-white" style="background: linear-gradient(grey,black);">User</span></td>
                    <?php endif; ?>
                    <td class="text-center">
                        <i class="<?= ($u['is_active']) ? 'far fa-fw fa-check-circle' : 'far fa-fw fa-times-circle'; ?>" style="color: <?= ($u['is_active']) ? 'green' : 'red'; ?>;"></i>
                    </td>
                    <td class="text-center">
                        <a href="<?= base_url('SuperAdmin/activationRole/' . $u['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-cog" style="color: white;"></i></a>
                    </td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>
        </table>
        <?php if ($search == null) : ?>
            <div>
                <?= $pager->links('akun', 'berkas_pager'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>