<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card">
        <div class="row m-5">
            <div class="col-md-5" style="padding-top: 30px;">
                <?php if ($menu['image'] == 'default.svg') : ?>
                    <img src="<?= base_url(); ?>/img/<?= ($menu['gender'] == '1') ? 'boy.svg' : 'girl.svg'; ?>" class="img-thumbnail">
                <?php else : ?>
                    <img src="<?= base_url(); ?>/img/<?= $menu['image']; ?>" class="img-thumbnail">
                <?php endif; ?>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title"><?= $menu['nama']; ?></h2>
                    <?php if ($menu['role_id'] == 1) : ?>
                        <span class="badge bg-primary text-light" style="background: linear-gradient(blue,black);"> <?= 'Super Administrator'; ?> </span>
                    <?php elseif ($menu['role_id'] == 2) :  ?>
                        <span class="badge bg-danger text-light" style="background: linear-gradient(red,black);"> <?= 'Administrator'; ?> </span>
                    <?php elseif ($menu['role_id'] == 3) :  ?>
                        <span class="badge bg-secondary text-light" style="background: linear-gradient(grey,black);"> <?= 'Users'; ?> </span>
                    <?php endif; ?>

                    <table class="table table-hover">
                        <tr>
                            <td>NIM</td>
                            <td><?= $menu['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><?= $menu['telepon']; ?></td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td><?php $jurusan = substr($menu['nim'], 0, 2); ?>
                                <?php if ($jurusan == '35') : ?>
                                    <?= 'Sistem Informasi'; ?>
                                <?php elseif ($jurusan == '36') : ?>
                                    <?= 'Teknik Informatika'; ?>
                                <?php elseif ($jurusan == '37') : ?>
                                    <?= 'Akuntansi'; ?>
                                <?php elseif ($jurusan == '38') : ?>
                                    <?= 'Manajemen'; ?>
                                <?php else : ?>
                                    <?= '-'; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td><?= $menu['tmptLahir']; ?>, <?= date('d-m-Y', strtotime($menu['tglLahir'])); ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?= ($menu['gender'] == '1') ? 'Laki - laki' : 'Perempuan'; ?></td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><?= $menu['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $menu['rtrw']; ?>, <?= $menu['desa']; ?>, <?= $menu['kecamatan']; ?>, <?= $menu['kota']; ?></td>
                        </tr>
                        <tr>
                            <?php if ($menu['id'] == '1') : ?>
                            <?php else : ?>
                                <?php if ($menu['role_id'] != 2) : ?>
                                    <td>Change Role</td>
                                    <td>
                                        <form action="<?= base_url(); ?>/Admin/updateActivation/<?= $menu['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_active" <?= ($menu['is_active'] == '1') ? 'checked' : ''; ?> name="is_active" value="1">
                                                <label class="custom-control-label" for="is_active"><?= ($menu['is_active'] == 1) ? 'Enable' : 'Disable' ?></label>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="text-center">
                                    <a href="<?= base_url('Admin'); ?>" class="btn-circle text-white" style="background: linear-gradient(grey,black);"><i class="fas fa-arrow-left"></i></a>
                                    <button type="submit" class="btn-circle text-white" style="background: linear-gradient(blue,black);"><i class="far fa-check-circle"></i></button>
                                    </form>
                                    <?php if ($menu['role_id'] != 2) : ?>
                                        <a class="nav-link btn-circle text-white" style="background: linear-gradient(red,black);" href="#" data-toggle="modal" data-target="#delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        <?php endif; ?>

                        </tr>
                    </table>
                    <p class="text-right"><small class="text-muted">Diperbarui pada <?= $menu['updated_at']; ?></small></p>
                </div>
            </div>
        </div>



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
                    <div class="modal-body">Anda yakin ingin menghapus user dengan NIM <?= $menu['nim']; ?>.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="<?= base_url(); ?>/Admin/deleteRole/<?= $menu['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<?= $this->endSection(); ?>