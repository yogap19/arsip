<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card p-3">
        <div class="row g-0">
            <div class="col-md-5 text-center" style="padding-top: 30px;">
                <?php if ($user['image'] == 'default.svg') : ?>
                    <img class="rounded" src="<?= base_url(); ?>/img/<?= ($user['gender'] == '1') ? 'boy.svg' : 'girl.svg'; ?>" width="400px" height="400px">
                <?php else : ?>
                    <img class="rounded" src="<?= base_url(); ?>/img/<?= $user['image']; ?>" width="400px" height="400px">
                <?php endif; ?>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title"><?= $user['nama']; ?></h2>
                    <?php if ($user['role_id'] == 1) : ?>
                        <span class="badge bg-primary text-light" style="background: linear-gradient(blue,black);"> <?= 'Super Administrator'; ?> </span>
                    <?php elseif ($user['role_id'] == 2) :  ?>
                        <span class="badge bg-danger text-light" style="background: linear-gradient(red,black);"> <?= 'Administrator'; ?> </span>
                    <?php elseif ($user['role_id'] == 3) :  ?>
                        <span class="badge bg-secondary text-light" style="background: linear-gradient(grey,black);"> <?= 'Users'; ?> </span>
                    <?php endif; ?>

                    <table class="table table-hover">
                        <tr>
                            <td>NIM</td>
                            <td><?= $user['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><?= $user['telepon']; ?></td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td><?php $jurusan = substr($user['nim'], 0, 2); ?>
                                <?php if ($jurusan == '35') : ?>
                                    <?= 'Sistem Informasi'; ?>
                                <?php elseif ($jurusan == '36') : ?>
                                    <?= 'Teknik Informatika'; ?>
                                <?php elseif ($jurusan == '37') : ?>
                                    <?= 'Akuntansi'; ?>
                                <?php elseif ($jurusan == '36') : ?>
                                    <?= 'Manajemen'; ?>
                                <?php elseif ($jurusan == '25') : ?>
                                    <?= 'Manajemen Informasi'; ?>
                                <?php elseif ($jurusan == '26') : ?>
                                    <?= 'Teknik Informatika D-3'; ?>
                                <?php elseif ($jurusan == '27') : ?>
                                    <?= 'Akuntansi D-3'; ?>
                                <?php elseif ($jurusan == '28') : ?>
                                    <?= 'Manajemen D-3'; ?>
                                <?php else : ?>
                                    <?= 'Jurusan belum terdaftar'; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td><?= $user['tmptLahir']; ?>, <?= date('d-m-Y', strtotime($user['tglLahir'])); ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?= ($user['gender'] == '1') ? 'Laki - laki' : 'Perempuan'; ?></td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><?= $user['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= substr($user['rtrw'], 0, 2); ?> / <?= substr($user['rtrw'], 2, 2); ?>, <?= $user['desa']; ?>, <?= $user['kecamatan']; ?>, <?= $user['kota']; ?></td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col">
                            <p class="text-left"><small class="text-muted">Dibuat pada <?= $user['created_at']; ?></small></p>
                        </div>
                        <div class="col">
                            <p class="text-right"><small class="text-muted">Diperbarui pada <?= $user['updated_at']; ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>