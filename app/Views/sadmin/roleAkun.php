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
        <table class="table table-hover">
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
            <?php $i = 1; ?>
            <?php foreach ($users as $key => $u) : ?>
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
        <div class="text-center">
        </div>
    </div>
</div>
<?= $this->endSection(); ?>