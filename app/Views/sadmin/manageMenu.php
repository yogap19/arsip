<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <table class="table table-hover">
            <tr class="text-white" style="background: linear-gradient(Blue, Black);">
                <th>NO</th>
                <th>Menu</th>
                <th>Access</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($menu as $key => $m) : ?>
                <tr>
                    <?php if ($m['menu_id'] != '1') : ?>
                        <td><?= $i; ?></td>

                        <td><?= $m['title']; ?></td>
                        <?php if ($m['menu_id'] == 1) : ?>
                            <td><span class="badge text-light" style="background: linear-gradient(blue,black);"><?= 'Super Administrator'; ?></span></td>
                        <?php elseif ($m['menu_id'] == 2) : ?>
                            <td>
                                <span class="badge text-light" style="background: linear-gradient(blue,black);"><?= 'Super Administrator'; ?></span>
                                <span class="badge text-light" style="background: linear-gradient(red,black);"><?= 'Administrator'; ?></span>
                            </td>
                        <?php elseif ($m['menu_id'] == 3) : ?>
                            <td>
                                <span class="badge text-light" style="background: linear-gradient(blue,black);"><?= 'Super Administrator'; ?></span>
                                <span class="badge text-light" style="background: linear-gradient(red,black);"><?= 'Administrator'; ?></span>
                                <span class="badge text-light" style="background: linear-gradient(grey,black);"><?= 'Users'; ?></span>
                            </td>
                        <?php elseif ($m['menu_id'] == 4) : ?>
                            <td>
                                <span class="badge text-light" style="background: linear-gradient(red,black);"><?= 'Administrator'; ?></span>
                            </td>
                        <?php elseif ($m['menu_id'] == 5) : ?>
                            <td>
                                <span class="badge text-light" style="background: linear-gradient(red,black);"><?= 'Administrator'; ?></span>
                                <span class="badge text-light" style="background: linear-gradient(grey,black);"><?= 'Users'; ?></span>
                            </td>
                        <?php endif; ?>
                        <td class="text-center">
                            <i class="<?= ($m['is_active']) ? 'far fa-fw fa-check-circle' : 'far fa-fw fa-times-circle'; ?>" style="color: <?= ($m['is_active']) ? 'green' : 'red'; ?>;"></i>
                        </td>
                        <?php $i++; ?>
                        <td class="text-center">
                            <form action="<?= base_url('SuperAdmin/activation/' . $m['id']); ?>"></form>
                            <a href="<?= base_url('SuperAdmin/activation/' . $m['id']); ?>" class="btn-circle" style="background: linear-gradient(green,black);"><i class="fas fa-fw fa-cog" style="color: white;"></i></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="text-center">
        </div>
    </div>
</div>




<?= $this->endSection(); ?>